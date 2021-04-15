<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function getAttendanceAttribute() {
        switch ($this->attend_church) {
            case 1:
                return 'Si';
            case 2:
                return 'Asiste a otra iglesia';
            case 3: 
                return 'Problemas físicos para asistir';
            default:
                return 'No';
        } 
    }
}
