<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $fillable = [
        'village_id',
        'union_type',
        'family_name',
        'address',
        'phone_number',
        'created_by',
        'updated_by'
    ];

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
            default:
                return 'Otro';
        }        
    }
}
