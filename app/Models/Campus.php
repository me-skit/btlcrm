<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'village_id',
        'address',
        'phone_number',
        'latitude',
        'longitude',
        'created_by',
        'updated_by'
    ];

    /**
     *  get the village that owns the campus
     */
    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function getLocationAttribute()
    {   
        if ($this->latitude and $this->longitude)
        {
            return $this->latitude . ', ' . $this->longitude;
        }
        else {
            return '';
        }
    }    
}
