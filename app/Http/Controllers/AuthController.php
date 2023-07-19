<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Resources\AuthResource;
// use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\StoreUserRequest;
use Throwable;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Repositories\UserRepository  $userRepository
     * @return void
     */
    public function __construct(protected UserRepository $userRepository)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUserRequest $request
     * @return \App\Http\Resources\AuthResource|\Illuminate\Http\JsonResponse
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
     * @param  \App\Http\Requests\StoreUserRequest $request
     * @return \App\Http\Resources\AuthResource|\Illuminate\Http\JsonResponse
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
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
