<?php

namespace News\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use News\Http\Controllers\Controller;
use News\User;
use Validator;

class RegisterController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $rules = [
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|between:4,255',
            'password_confirmation' => 'required|min:4|same:password',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()], 401);
        }
        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken(env('APP_NAME'))->accessToken;
        return response()->json(["success" => ['access_token' => $token]], 201);
    }
}
