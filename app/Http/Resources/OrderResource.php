<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'person_id' => $this->person_id,
            'items' => $this->items,
            'address' => $this->address,
            'created_at' => $this->created_at, 
            'updated_at' => $this->updated_at, 
        ];
    }
}
