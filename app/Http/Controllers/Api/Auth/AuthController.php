<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\VerifyCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class AuthController extends Controller
{

    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $phoneVerified = VerifyCode::query()
            ->where('phone_number', $validated['phone_number'])
            ->where('status', 1)
            ->latest()
            ->first();

        if ($phoneVerified) {
            $phoneVerified->delete();
            $user = User::query()->where('phone_number', $validated['phone_number'])->first();

            if ($user) {
                $token = $user->createToken("access_token")->plainTextToken;
            } else {
                return new JsonResponse([
                    'message' => 'Пользователь не найден',
                ], 401);
            }

            return new JsonResponse([
                'data' => [
                    'user' => UserResource::make($user),
                    'token' => $token
                ]
            ], 200);
        } else {
            return new JsonResponse(['phone not verified'], 500);
        }
    }


    public function register(RegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $phoneVerified = VerifyCode::query()
            ->where('phone_number', $validated['phone_number'])
            ->where('status', 1)
            ->latest()
            ->first();

        if ($phoneVerified) {
            $user = User::query()->create($validated);
            $user->assignRole('user');

            if ($user) {
                $token = $user->createToken("access_token")->plainTextToken;
            } else {
                return new JsonResponse([
                    'message' => 'Пользователь не найден',
                ], 401);
            }

            return new JsonResponse([
                'data' => [
                    'user' => UserResource::make($user),
                    'token' => $token
                ]
            ], 200);
        } else {
            return new JsonResponse(['phone not verified'], 500);
        }
    }

    public function logout(): JsonResponse
    {
        $user = Auth::user();

        $user->tokens()->delete();

        return response()->json([], 204);
    }
}
