<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function registerUser(array $request);
}
