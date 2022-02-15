<?php

namespace App\Models\Dialog;

use App\Models\BaseModel;

class Dialog extends BaseModel
{
    protected $fillable = [
        'name'
    ];

    public function messages()
    {
        return $this->hasMany(DialogMessage::class);
    }
}
