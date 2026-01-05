<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TravelResource extends JsonResource
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
            'isPublic' => $this->is_public,
            'name' => $this->name,
            'type' => $this->type,
            'numberOfDays' => $this->number_of_days,
            'tours' => TourResource::collection($this->whenLoaded('tours')),
        ];
    }
}
