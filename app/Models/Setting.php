<?php

namespace App\Models;

use App\Events\SettingsUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'value', 'hash'];

    protected $dispatchesEvents = [
        'saved' => SettingsUpdate::class
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('\App\Models\User');
    }

    public static function getValue($setting, $default = null)
    {
        $s = self::where('name', $setting)->first();
        if ($s == null) {
            return $default;
        }
        return $s->value;
    }
}
