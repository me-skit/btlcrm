<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'discipline_type',
        'act_number',
        'start_date',
        'end_date'
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function getDescriptionAttribute()
    {
        switch ($this->discipline_type) {
            case 3:
                return 'Tres meses';
            case 6:
                return 'Seis meses';
            default:
                return 'Tiempo indefinido';                
        }        
    }

    public function getIsActiveAttribute()
    {
        return $this->end_date and $this->end_date < date("Y-m-d") ? false : true;
    }
}
