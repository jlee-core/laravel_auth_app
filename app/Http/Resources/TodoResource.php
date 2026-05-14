<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'body' => $this->body,
            'is_done' => (bool) $this->is_done,
            'created_date' => $this->created_at?->format('Y-m-d'),
            'updated_date' => $this->updated_at?->format('Y-m-d'),
        ];
    }
}
