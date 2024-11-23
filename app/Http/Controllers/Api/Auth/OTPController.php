<?php

namespace App\Http\Controllers\Api\Auth;

use Alexvexone\LaravelOperSms\OperSmsService;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Models\User;
use App\Models\VerifyCode;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class OTPController extends Controller
{
    /**
     * Sending code to user phone number
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws \Exception
     */
    public function sendOTP(LoginRequest $request): JsonResponse
    {
        //validate
        $validated = $request->validated();

        // Todo delete it
//        $verifyCode = VerifyCode::query()->create([
//            'phone_number' => $validated['phone_number'],
//            'code' => 111111
//        ]);

        //return response
//        return new JsonResponse(200);

        //random code
        $code = rand(100000, 999999);
        if ($validated['phone_number'] == '998912345678') {
            $code = 111111;
        }

        //text for sent user phone number
        $sentText = $code . " – это ваш одноразовый код для доступа в Wedding.";

        //sending text
        $sent = OperSmsService::send($validated['phone_number'], $sentText);

        if (gettype($sent) == "array") {
            //saving sending code in db
            $verifyCode = VerifyCode::query()->create([
                'phone_number' => $validated['phone_number'],
                'code' => $code
            ]);

            //return response
            return new JsonResponse(200);
        } else {
            abort(429);
        }
    }

    /**
     * Checking written code
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function checkCode(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        //getting sending code by phone number
        $phone = VerifyCode::query()->where('phone_number', $validated['phone_number'])->latest()->first();

        if ($phone && (int)$phone->code === (int)$request->input('code')) {
            VerifyCode::query()->update([
                'status' => true
            ]);
            return new JsonResponse(['status' => true], Response::HTTP_OK);
        }

        //return error
        return new JsonResponse(['status' => false, 'message' => 'Invalid code'], Response::HTTP_FORBIDDEN);
    }

}
