<?php

namespace App\Models\Dialog;

use App\Models\BaseModel;
use App\Models\User;


class DialogMessage extends BaseModel
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
