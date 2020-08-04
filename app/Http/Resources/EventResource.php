<?php

namespace App\Http\Resources;

use App\Http\Controllers\helper\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'sport' => new SportResource($this->whenLoaded('sport')),
            'team_1' => new TeamResource($this->whenLoaded('team_1')),
            'team_2' => new TeamResource($this->whenLoaded('team_2')),
        ];
    }
}
