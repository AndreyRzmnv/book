<?php

namespace App\Models\Category;

use App\Models\BaseModel;
use App\Models\Subject\Subject;

class Category extends BaseModel
{
    protected $fillable = [
        'subject_id',
        'name'
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
