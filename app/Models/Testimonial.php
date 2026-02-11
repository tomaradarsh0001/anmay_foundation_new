<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;
     protected $fillable = [
        'text',
        'name',
        'profession',
        'image'

    ];
     protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        
        // Return default avatar based on initials
        $name = $this->name ?? 'User';
        $initials = strtoupper(substr($name, 0, 1));
        return "https://ui-avatars.com/api/?name=" . urlencode($name) . "&color=7F9CF5&background=EBF4FF";
    }
}
