<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $guarded = [];

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
        if ($this->longitude and $this->latitude)
        {
            return $this->longitude . ', ' . $this->latitude;
        }
        else {
            return '';
        }
    }    
}
