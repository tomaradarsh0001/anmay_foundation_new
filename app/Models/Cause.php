<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cause extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'heading',
        'content',
        'target_goal',
        'raised',
        'image',
    ];
}


