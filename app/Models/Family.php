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
        'zone',
        'address',
        'latitude',
        'longitude',
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
        return $this->belongsToMany(Person::class, 'family_members')->withPivot('family_role', 'active')->orderByPivot('family_role');
    }

    public function getFamilyNamesAttribute() {
        return explode(' ', $this->family_name);
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
