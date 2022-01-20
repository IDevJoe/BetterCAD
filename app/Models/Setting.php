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

    public static function getValueObject($setting, $default = null)
    {
        $set = self::getValue($setting);
        $dec = base64_decode($set);
        $obj = json_decode($dec);
        if (json_last_error() === JSON_ERROR_NONE) {
            return $obj;
        }
        return $default;
    }

    public static function getManifest()
    {
        return self::getValueObject('MANIFEST', json_decode(file_get_contents(base_path('defaultmanifest.json'))));
    }
}
