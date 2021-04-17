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

    public function privileges()
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

    public function getFullNameAttribute() {
        $fullname = [$this->first_name, $this->second_name, $this->third_name, $this->first_surname, $this->second_surname];
        return implode(' ', array_filter($fullname));
    }    
}
