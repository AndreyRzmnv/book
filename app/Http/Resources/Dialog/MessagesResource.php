<?php

namespace App\Http\Resources\Dialog;

use Illuminate\Http\Resources\Json\JsonResource;

class MessagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // dd($this);
        return [
            'id' => $this->id,
            'user_name' => $this->user->name,
            'text' => $this->text,
            'created_at' => $this->created_at->format('d.m.Y'),
        ];
    }
}
