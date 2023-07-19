<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  App\Models\User|Illuminate\Support\Facades\Auth $user
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($user)
    {
        return [
            'token_type' => 'Bearer',
            'token' => $this->createToken('auth-token')->plainTextToken
        ];
    }
}
