<?php

// app/Models/WebsiteDetail.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone',
        'email',
        'address',
        'instagram',
        'twitter',
        'facebook',
        'linkedin',
        'youtube',
    ];
}
