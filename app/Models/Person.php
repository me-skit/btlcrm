<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
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

    public const NO_MEMBER = 0;
    public const MEMBER = 1;
    public const UNBAPTIZED = 0;
    public const BAPTIZED = 1;
    public const UNACCEPTED = 0;
    public const ACCEPTED = 1;

    protected const SECONDS_PER_YEAR = 31536000;

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

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucfirst(strtolower($value));
    }

    public function setSecondNameAttribute($value)
    {
        $this->attributes['second_name'] = ucfirst(strtolower($value));
    }

    public function setThirdNameAttribute($value)
    {
        $this->attributes['third_name'] = ucfirst(strtolower($value));
    }

    public function setFirstSurnameAttribute($value)
    {
        $this->attributes['first_surname'] = ucfirst(strtolower($value));
    }

    public function setSecondSurnameAttribute($value)
    {
        $this->attributes['second_surname'] = ucfirst(strtolower($value));
    }

    public function getFullNameAttribute() {
        $fullname = [$this->first_name, $this->second_name, $this->third_name, $this->first_surname, $this->second_surname];
        return implode(' ', array_filter($fullname));
    }

    public function getCivilStatusAttribute()
    {
        switch ($this->status)
        {
            case 1:
                return $this->sex === 'M' ? 'Soltero' : 'Soltera';
            case 2:
                return $this->sex === 'M' ? 'Casado' : 'Casada ';
            case 3:
                return $this->sex === 'M' ? 'Unido' : 'Unida';
            case 4: 
                return $this->sex === 'M' ? 'Divorciado' : 'Divorciada';
            case 6:
                return $this->sex === 'M' ? 'Viudo' : 'Viuda';
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

    public function getSexDecodedAttribute()
    {
        return $this->sex === 'M' ? "Masculino" : "Femenino";
    }

    public function getMemberAttribute()
    {
        return $this->membership->member ? ($this->membership->member == 1 ? "Si" : "De otra iglesia") : "No";
    }

    public function getAgeAttribute()
    {
        if ($this->death_date)
        {
            return floor((strtotime($this->death_date) -  strtotime($this->birthday)) / $this->SECONDS_PER_YEAR);
        }
        else
        {
            return Carbon::parse($this->birthday)->age;
        }
    }

    public function getFormattedBirthdayAttribute()
    {
        return Carbon::parse($this->birthday)->format('d/m/Y');
    }

    public function getAttendChurchAttribute($value)
    {
        return $value ? ($value == 1 ? "Si" : ($value == 2 ? "En ocasiones" : "Con problemas")) : "No";
    }

    public function getReligionAttribute($value)
    {
        switch ($value) {
            case 1:
                return $this->sex === 'M' ? "Evangélico" : "Evangélica";
            case 2:
                return $this->sex === 'M' ? "Católico" : "Católica";
            case 3:
                return $this->sex === 'M' ? "Mormon" : "Mormona";
            case 4:
                return "Adventista";
            default:
                return 'Ninguna';
        }
    }

    // static methods
    public static function queryPeopleByMembership($membership, $substr)
    {
        return Person::where('death_date', null)
                    ->join('memberships', function($query) use ($membership) {
                        $query->on('people.id', '=', 'memberships.person_id')
                            ->where('memberships.member', $membership);
                        })
                    ->where(DB::raw('CONCAT_WS(" ", first_name, second_name, third_name, first_surname, second_surname)'), 'like', '%' . $substr . '%')
                    ->orderBy('first_name')
                    ->orderBy('second_name')
                    ->orderBy('third_name')
                    ->orderBy('first_surname')
                    ->orderBy('second_surname')
                    ->with('membership')
                    ->paginate(35);
    }

    public static function getPeopleByMembership($membership)
    {
        return Person::where('death_date', null)
                    ->join('memberships', function($query) use ($membership) {
                        $query->on('people.id', '=', 'memberships.person_id')
                            ->where('memberships.member', $membership);
                    })
                    ->orderBy('first_name')
                    ->orderBy('second_name')
                    ->orderBy('third_name')
                    ->orderBy('first_surname')
                    ->orderBy('second_surname')
                    ->with('membership')
                    ->paginate(35);
    }

    public static function queryMembersBy($field, $value, $substr)
    {
        return Person::where('death_date', null)
                    ->join('memberships', function($query) use ($field, $value) {
                        $query->on('people.id', '=', 'memberships.person_id')
                            ->where('memberships.member', Person::MEMBER)
                            ->where('memberships.' . $field, $value);
                        })
                    ->where(DB::raw('CONCAT_WS(" ", first_name, second_name, third_name, first_surname, second_surname)'), 'like', '%' . $substr . '%')
                    ->orderBy('first_name')
                    ->orderBy('second_name')
                    ->orderBy('third_name')
                    ->orderBy('first_surname')
                    ->orderBy('second_surname')
                    ->with('membership')
                    ->paginate(35);
    }

    public static function getMembersBy($field, $value)
    {
        return Person::where('death_date', null)
                    ->join('memberships', function($query) use ($field, $value) {
                        $query->on('people.id', '=', 'memberships.person_id')
                            ->where('memberships.member', Person::MEMBER)
                            ->where('memberships.' . $field, $value);
                    })
                    ->orderBy('first_name')
                    ->orderBy('second_name')
                    ->orderBy('third_name')
                    ->orderBy('first_surname')
                    ->orderBy('second_surname')
                    ->with('membership')
                    ->paginate(35);
    }
}
