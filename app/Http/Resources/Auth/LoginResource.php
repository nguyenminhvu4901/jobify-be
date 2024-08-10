<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => [
                'id' => $this['user']->id,
                'full_name' => $this['user']->full_name,
                'username' => $this['user']->username,
                'email' => $this['user']->email,
            ],
            'token_type' => 'Bearer',
            'token' => $this['token'],
            'expires_in_token' => config('sanctum.expiration'),
        ];
    }
}
