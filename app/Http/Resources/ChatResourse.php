<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'image'=>$this->user['image']??$this->user,
            'user_id'=>$this->user['id']??$this->user,
            'name'=>$this->user['name']??$this->user,
            'text'=>$this->messages->last()['text'],
            'time'=>$this->updated_at,
            'count'=>$this->count,
            'reader'=>$this->reader,
        ];
    }
}
