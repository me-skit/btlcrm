<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $guarded = [];

    /**
     *  get the village in wich the family live
     */
    public function village()
    {
        return $this->belongsTo(Village::class);
    }

    /**
     *  get family members
     */
    public function members()
    {
        return $this->belongsToMany(Person::class, 'family_members')->withPivot('family_role', 'active');
    }

    public function getFamilyNamesAttribute() {
        return explode(' ', $this->family_name);
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

    public function getUnionAttribute()
    {
        switch ($this->union_type)
        {
            case 1:
                return 'Casados';
            case 2:
                return 'Unidos';
            case 3:
                return 'Divorciados';
            case 4: 
                return 'Separados';
        }        
    }
}
