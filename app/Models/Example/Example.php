<?php

namespace App\Models\Example;

use App\Models\BaseModel;
use App\Models\Subcategory\Subcategory;

class Example extends BaseModel
{
    protected $fillable = [
        'subcategory_id',
        'name',
    ];

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }
}
