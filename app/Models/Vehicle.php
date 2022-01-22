<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'plate_number', 'make', 'model', 'color', 'insurance_status', 'state', 'registration_status',
        'character_id'
    ];

    public function character()
    {
        return $this->belongsTo('\App\Models\Character');
    }

    public function dbAnswer()
    {
        $alerts = "";
        if ($this->insurance_status != "V") {
            switch ($this->insurance_status) {
                case "E":
                    $alerts .= "!! INSURANCE EXPIRED";
                    break;
                case "N":
                    $alerts .= "!! NO INSURANCE";
                    break;
            }
        }
        if ($this->registration_status != "V") {
            switch ($this->registration_status) {
                case "E":
                    $alerts .= "!! REGISTRATION EXPIRED\n";
                    break;
                case "S":
                    $alerts .= "!! REGISTRATION SUSPENDED\n";
                    break;
                case "C":
                    $alerts .= "!! REGISTRATION CANCELLED\n";
                    break;
                case "WA":
                    $alerts .= "!! VEHICLE WANTED *********\n";
                    break;
                case "ST":
                    $alerts .= "!! VEHICLE STOLEN *********\n";
                    break;
            }
        }
        return strtoupper(
            $this->state . "\t" . $this->plate_number
            . "\n" . $this->color . "\t" . $this->make . "\t" . $this->model
            . "\nINS - " . $this->insurance_status . "\tREG - " . $this->registration_status
            . "\n" . $alerts
        );
    }
}
