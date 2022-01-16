<?php

namespace App\Models\Subject;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends BaseModel
{
    protected $fillable = ['name', 'color'];
}
