<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'fname', 'lname', 'dob', 'hair_color', 'eye_color', 'address', 'gender', 'race', 'height', 'weight'
    ];

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }
}
