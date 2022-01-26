<?php

namespace App\Http\Resources\Subcategory;

use Illuminate\Http\Resources\Json\JsonResource;

class SubcategorySelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name . ', Категория: ' . $this->category->name . ', Тема: ' . $this->category->subject->name,
        ];
    }
}
