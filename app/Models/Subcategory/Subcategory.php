<?php

namespace App\Models\Subcategory;

use App\Models\BaseModel;
use App\Models\Category\Category;

class Subcategory extends BaseModel
{
    protected $fillable = [
        'category_id',
        'name'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
