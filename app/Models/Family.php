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
}
