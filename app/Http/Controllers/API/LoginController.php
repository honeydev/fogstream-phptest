<?php

declare(strict_types=1);

namespace News\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use News\Http\Controllers\Controller;
use News\User;
use Validator;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $user->createToken(env('APP_NAME'));
            return response()->json(['access_token' => $token->accessToken], 200);
        }
        return response()->json(["error" => "Auth error"], 401);
    }
}
