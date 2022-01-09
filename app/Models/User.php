<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use HasPermissions;
    use HasRoles;

    public const AVAILABLE_PERMISSIONS = [
        "view admin panel",
        "modify standard settings",
        "modify roles",
        "modify users",
        "modify departments",
        "view audit logs",

        "access dispatch dashboard",
        "access leo dashboard",
        "access civilian dashboard",
        "lookup civilian records"
    ];

    protected $appends = ['effectivePermissions'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getEffectivePermissionsAttribute()
    {
        $perms = [];
        foreach (self::AVAILABLE_PERMISSIONS as $perm) {
            if ($this->hasPermissionTo($perm)) {
                array_push($perms, $perm);
            }
        }
        return $perms;
    }

    public function characters()
    {
        return $this->hasMany('\App\Models\Character');
    }
}
