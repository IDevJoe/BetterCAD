<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'fname', 'lname', 'dob', 'hair_color', 'eye_color', 'address', 'gender', 'race', 'height', 'weight',
        'dl_type', 'dl_status', 'dl_expiry', 'wl_status', 'wl_expiry', 'bl_status', 'bl_expiry', 'pl_type', 'pl_status',
        'pl_expiry', 'dead', 'dead_since'
    ];

    protected $with = ['vehicles'];

    /*protected $casts = [
        'dl_expiry' => 'date',
        'wl_expiry' => 'date',
        'bl_expiry' => 'date',
        'pl_expiry' => 'date'
    ];*/

    public function user()
    {
        return $this->belongsTo('\App\Models\User');
    }

    public function vehicles()
    {
        return $this->hasMany('\App\Models\Vehicle');
    }

    public function dbAnswer()
    {
        $alerts = "";
        $dl = "DL/" . $this->dl_type;
        $dl_stat = "V";
        if ($this->dl_expiry != null && Carbon::now()->isAfter($this->dl_expiry)) {
            $dl_stat = "EXP";
            $alerts .= "!! DRIVERS LICENSE IS EXPIRED\n";
        }
        if ($this->dl_status != "V") {
            $dl_stat = $this->dl_status;
            switch ($this->dl_status) {
                case "S":
                    $alerts .= "!! DRIVERS LICENSE IS SUSPENDED\n";
                    break;
                case "R":
                    $alerts .= "!! DRIVERS LICENSE IS REVOKED\n";
                    break;
            }
        }
        if ($this->dl_type == "U") {
            $dl_stat = "X";
        }
        $wl_stat = "V";
        if ($this->wl_expiry != null && Carbon::now()->isAfter($this->wl_expiry)) {
            $wl_stat = "EXP";
            $alerts .= "!! WEAPONS LICENSE IS EXPIRED\n";
        }
        if ($this->wl_status != "V") {
            $wl_stat = $this->wl_status;
            switch ($this->wl_status) {
                case "S":
                    $alerts .= "!! WEAPONS LICENSE IS SUSPENDED\n";
                    break;
                case "R":
                    $alerts .= "!! WEAPONS LICENSE IS REVOKED\n";
                    break;
            }
        }
        $bl_stat = "V";
        if ($this->bl_expiry != null && Carbon::now()->isAfter($this->bl_expiry)) {
            $bl_stat = "EXP";
            $alerts .= "!! BOATING LICENSE IS EXPIRED\n";
        }
        if ($this->bl_status != "V") {
            $bl_stat = $this->bl_status;
        }
        $pl = "PL/" . $this->pl_type;
        $pl_stat = "V";
        if ($this->pl_expiry != null && Carbon::now()->isAfter($this->pl_expiry)) {
            $pl_stat = "EXP";
            $alerts .= "!! PILOTS LICENSE IS EXPIRED\n";
        }
        if ($this->pl_status != "V") {
            $pl_stat = $this->pl_status;
            switch ($this->pl_status) {
                case "S":
                    $alerts .= "!! PILOTS LICENSE IS SUSPENDED\n";
                    break;
                case "R":
                    $alerts .= "!! PILOTS LICENSE IS REVOKED\n";
                    break;
            }
        }
        if ($this->pl_type == "U") {
            $pl_stat = "X";
        }
        if ($this->dead) {
            $alerts .= "!! DEAD SINCE " . $this->dead_since . "\n";
        }
        return strtoupper(
            $this->lname . ",\t" . $this->fname . "\t(" . $this->race . "/" . $this->gender . ")\t" . $this->dob
            . "\nHAIR - " . $this->hair_color . "\tEYES - " . $this->eye_color . "\tHT - " . $this->height
            . "\tWT - " . $this->weight
            . "\nADDRESS - " . $this->address
            . "\n" . $dl . " - " . $dl_stat . "\tWL - " . $wl_stat . "\tBL - " . $bl_stat
            . "\t" . $pl . " - " . $pl_stat
            . "\n" . $alerts
        );
    }
}
