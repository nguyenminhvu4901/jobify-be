<?php

namespace App\Traits\Resources;

use App\Http\Resources\DefaultStatus\DefaultStatusResource;

trait UserResourceTrait
{
    /**
     * @return array
     */
    protected function userData(): array
    {
        return [
            'id' => $this->id,
            'full_name' => $this->full_name,
            'slug' => $this->slug,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'current_role' => $this->current_role,
            'status' => new DefaultStatusResource($this->status),
            'avatar' => $this->avatar,
            'created_at' => formatDateTime($this->created_at),
            'updated_at' => formatDateTime($this->updated_at),
        ];
    }
}
