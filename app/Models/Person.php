<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'preferences' => 'array',
        'diseases' => 'array',
        'handicaps' => 'array'
    ];

    /**
     *  get the families which the person belongs
     */
    public function families()
    {
        return $this->belongsToMany(Family::class, 'family_members')->withPivot('family_role', 'active');
    }

    /**
     *  get the family which the person belongs currently
     */
    public function family()
    {
        return $this->belongsToMany(Family::class, 'family_members')->withPivot('family_role', 'active')->wherePivot('active', 1)->first();
    }

    /**
     *  get the family which the person belonged in case He/She is dead
     */
    public function familyBelonged()
    {
        return $this->belongsToMany(Family::class, 'family_members')->withPivot('family_role', 'active')->wherePivot('active', 2)->first();
    }

    /**
     *  get the family which the person belongs before the current family
     */
    public function familyBefore()
    {
        return $this->belongsToMany(Family::class, 'family_members')->withPivot('family_role', 'active')->wherePivot('active', 0);
    }
  
    /**
     *  get the membership information of the person
     */    
    public function membership()
    {
        return $this->hasOne(Membership::class);
    }

    public function privilege_history()
    {
        return $this->belongsToMany(Privilege::class, 'privilege_histories')
                    ->withPivot('id', 'privilege_role_id', 'start_date', 'end_date')
                    ->using(PrivilegeHistory::class)
                    ->orderBy('privilege_histories.created_at', 'DESC');
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class)
                    ->orderBy('created_at', 'DESC');
    }

    public function discipline()
    {
        return $this->hasMany(Discipline::class)
                    ->where('ended', '0')->first();
    }

    public function getFullNameAttribute() {
        $fullname = [$this->first_name, $this->second_name, $this->third_name, $this->first_surname, $this->second_surname];
        return implode(' ', array_filter($fullname));
    }

    public function getCivilStatusAttribute()
    {
        if ($this->sex === 'M')
        {
            switch ($this->status)
            {
                case 1:
                    return 'Casado';
                case 2:
                    return 'Soltero';
                case 3:
                    return 'Unido';
                case 4: 
                    return 'Divorciado';
                case 6:
                    return 'Viudo';
            }
        }
        else
        {
            switch ($this->status)
            {
                case 1:
                    return 'Casada';
                case 2:
                    return 'Soltera';
                case 3:
                    return 'Unida';
                case 4: 
                    return 'Divorciada';
                case 6:
                    return 'Viuda';
            }
        }

    }

    public function getFamilyRoleAttribute()
    {
        $role = $this->pivot ? $this->pivot->family_role : $this->family()->pivot->family_role;

        switch ($role) {
            case 1:
                return 'Padre/Esposo';
            case 2:
                return 'Madre/Esposa';
            case 3:
                return 'Hijo';
            default:
                return 'Hija';
        }
    }
}
