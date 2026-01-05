<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TourResource extends JsonResource
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
            'travelId' => $this->travel_id,
            'name' => $this->name,
            'description' => $this->description,
            'status' => $this->status,
            'startingDate' => $this->starting_date,
            'endingDate' => $this->ending_date,
            'price' => number_format($this->price,2),
        ];
    }
}
