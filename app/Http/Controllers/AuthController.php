<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Throwable;
use App\Http\Requests\StoreUserRequest;
use App\Repositories\UserRepository;
use App\Http\Resources\AuthResource;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Repositories\UserRepository  $userRepository
     * @return void
     */
    public function __construct(protected UserRepository $userRepository)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreUserRequest $request
     * @return App\Http\Resources\AuthResource|\Illuminate\Http\Response
     */
    public function register(StoreUserRequest $request)
    {
        try {
            $user = $this->userRepository->registerUser($request);
            
            return new AuthResource($user);
        } catch (Throwable $th) {
            return response()->json(["message" => "error when trying to register the user"], 500);
        }
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  App\Http\Requests\StoreUserRequest $request
     * @return App\Http\Resources\AuthResource|\Illuminate\Http\Response
     */
    public function login(StoreUserRequest $request)
    {
        try {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                if (!empty($request->user()->tokens)) {
                    $request->user()->tokens()->delete();
                }
    
                return new AuthResource(Auth::user());
            }
    
            return response()->json(["message" => "invalid credentials"], 422);
        } catch (Throwable $th) {
            return response()->json(["message" => "error when trying to authenticate the user"], 500);
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

            return response()->json(['message' => 'Logged out successfully'], 200);
        } catch (Throwable $th) {
            return response()->json(["message" => "error when trying to logout the user"], 500);
        }
    }
}
