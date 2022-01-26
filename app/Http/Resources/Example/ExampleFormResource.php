<?php

namespace App\Http\Resources\Example;

use App\Http\Resources\Subcategory\SubcategorySelectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ExampleFormResource extends JsonResource
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
            'name' => $this->name,
            'blocks' => ExampleBlockFormResource::collection($this->exampleBlocks),
            'subcategory' => new SubcategorySelectResource($this->subcategory),
        ];
    }
}
