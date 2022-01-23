<?php

namespace App\Models\Example;

use App\Models\BaseModel;

class ExampleBlock extends BaseModel
{
    protected $fillable = [
        'example_id',
        'name',
        'description'
    ];
}
