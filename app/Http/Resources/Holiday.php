<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Holiday extends JsonResource
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
            'title' => $this->title,
            'description' => $this->description,
            'startDate' => $this->start_date->format('Y-m-d'),
            'endDate' => $this->end_date->format('Y-m-d'),
            'can_edit' => \Gate::allows('update', $this->resource),
            'can_delete' => \Gate::allows('delete', $this->resource),
        ];
    }
}
