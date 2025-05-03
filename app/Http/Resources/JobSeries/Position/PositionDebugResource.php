<?php

namespace App\Http\Resources\JobSeries\Position;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionDebugResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            '_lft' => $this->_lft,
            '_rgt' => $this->_rgt,
            'parent_id' => $this->parent_id,
            'depth' => $this->depth,
            'children' => PositionResource::collection($this->children)
        ];
    }
}
