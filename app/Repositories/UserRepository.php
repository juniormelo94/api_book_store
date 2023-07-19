<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Store a newly created resource in storage.
     *
     * @param App\Models\Book $model
     * @return void
     */
    public function __construct(protected User $model)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function registerUser($request)
    {
        $user = $this->model;

        return tap($user, function ($user) use ($request) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request['password']);
            $user->save();
        });
    }
}
