<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), 
            [
                "email"  => ["required", "email"],
                "password" => ["required", "string"],
            ], User::messages());
    
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()
                ], 400);
            }
    
            $credentials = $request->only('email', 'password');
    
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $token = $user->createToken('auth-token')->plainTextToken;
    
                return response()->json([
                    "status" => "ok",
                    "token" => $token
                ], 201);
            }
    
            return response()->json([
                "status" => "error",
                "message" => "invalid credentials"
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "error when trying to authenticate the user"
            ], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), User::rules(), User::messages());
    
            if ($validator->fails()) {
                return response()->json([
                    "status" => "error",
                    "message" => $validator->errors()
                ], 400);
            }
    
            $request['password'] = Hash::make($request['password']);
    
            $user = User::create($request->all());
            
            $token = $user->createToken('auth-token')->plainTextToken;

            return response()->json([
                "status" => "ok",
                "message" => "user record created",
                "token" => $token
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "error when trying to register the user"
            ], 400);
        }
    }

    /**
     * User logged out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        try {
            $request->user()->currentAccessToken()->delete();

            return response()->json([
                "status" => "ok",
                'message' => 'Logged out successfully'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "error when trying to logout the user"
            ], 400);
        }
    }
}
