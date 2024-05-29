<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserLoginRequest;
use App\Http\Requests\User\UserRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Models\VerifyCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(UserLoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $phoneVerified = VerifyCode::query()->where('phone_number', $validated['phone_number'])->latest()->where('status', true)->first();

        if ($phoneVerified) {
            $phoneVerified->delete();
            $user = User::query()->where('phone_number', $validated['phone_number'])->first();

            if ($user)
                $token = $user->createToken("access_token")->plainTextToken;
            else
                return new JsonResponse([
                    'message' => 'Пользователь не найден',
                ], 401);

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


    public function register(UserRegisterRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = User::query()->create($validated);

        $phoneVerified = VerifyCode::query()->where('phone_number', $validated['phone_number'])->latest()->where('status', true)->first();

        if ($phoneVerified) {
            if ($user)
                $token = $user->createToken("access_token")->plainTextToken;
            else
                return new JsonResponse([
                    'message' => 'Пользователь не найден',
                ], 401);

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
