<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class TaskResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'title'             => $this->title,
            'description'       => $this->description,
            'completed_at'      => $this->completed_at,
            'completed_time'    => $this->completed_time,
            'created_at'        => $this->created_at,
        ];
    }
}
