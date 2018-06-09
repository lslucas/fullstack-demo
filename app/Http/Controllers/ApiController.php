<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    /**
     * API Login
     * 
     * @return \Illuminate\Http\Response passport json
     */
    public function auth(Request $request)
    {
        if (\App\User::where('email', $request->email)->count()) {

            $credentials = $request->only('email', 'password');

            if (!Auth::attempt($credentials)) {
                return response()->json(['message' => 'Bad credentials'], 401);
            }

            $passport = \Auth::user()->createToken('fullstack');

            return response()->json([
                'access_token' => $passport->accessToken,
                'created_at' => $passport->token->created_at,
                'expires_at' => $passport->token->expires_at
            ], 200);
        }

        return response()->json(['message' => 'Email doesn\'t exist.'], 404);
    }

}
