<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'fname', 'lname', 'dob', 'hair_color', 'eye_color', 'address', 'gender', 'race', 'height', 'weight',
        'dl_type', 'dl_status', 'dl_expiry', 'wl_status', 'wl_expiry', 'bl_status', 'bl_expiry', 'pl_type', 'pl_status',
        'pl_expiry', 'dead'
    ];

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }
}
