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

    protected const SECONDS_PER_YEAR = 31536000;
    protected const PAGINATION = 35;

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
        $this->attributes['first_name'] = ucfirst(mb_strtolower($value));
    }

    public function setSecondNameAttribute($value)
    {
        $this->attributes['second_name'] = ucfirst(mb_strtolower($value));
    }

    public function setThirdNameAttribute($value)
    {
        $this->attributes['third_name'] = ucfirst(mb_strtolower($value));
    }

    public function setFirstSurnameAttribute($value)
    {
        $this->attributes['first_surname'] = ucfirst(mb_strtolower($value));
    }

    public function setSecondSurnameAttribute($value)
    {
        $this->attributes['second_surname'] = ucfirst(mb_strtolower($value));
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
            case 5: 
                return $this->sex === 'M' ? 'Separado' : 'Separada';
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
                    ->paginate(Person::PAGINATION);
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
                    ->paginate(Person::PAGINATION);
    }

    public static function queryMembersWith($field, $substr)
    {
        return Person::where('death_date', null)
                    ->whereNotNull($field)
                    ->join('memberships', function($query) {
                        $query->on('people.id', '=', 'memberships.person_id')
                            ->where('memberships.member', Person::MEMBER);
                        })
                    ->where(DB::raw('CONCAT_WS(" ", first_name, second_name, third_name, first_surname, second_surname)'), 'like', '%' . $substr . '%')
                    ->orderBy('first_name')
                    ->orderBy('second_name')
                    ->orderBy('third_name')
                    ->orderBy('first_surname')
                    ->orderBy('second_surname')
                    ->with('membership')
                    ->paginate(Person::PAGINATION);
    }

    public static function getMembersWith($field)
    {
        return Person::where('death_date', null)
                    ->whereNotNull($field)
                    ->join('memberships', function($query) {
                        $query->on('people.id', '=', 'memberships.person_id')
                            ->where('memberships.member', Person::MEMBER);
                    })
                    ->orderBy('first_name')
                    ->orderBy('second_name')
                    ->orderBy('third_name')
                    ->orderBy('first_surname')
                    ->orderBy('second_surname')
                    ->with('membership')
                    ->paginate(Person::PAGINATION);
    }

    public static function queryMembers($accepted, $baptized, $status, $sex, $min, $max)
    {
        $details = array(array('death_date', null));
        $membership = array(array('memberships.member', Person::MEMBER));

        // add membership conditions
        if ($accepted != -1)
        {
            $membership[] = array('memberships.accepted', $accepted);
        }

        if ($baptized != -1)
        {
            $membership[] = array('memberships.baptized', $baptized);
        }

        // add people conditions
        if ($status != 0)
        {
            $details[] = array('status', $status);
        }

        if ($sex != 'B')
        {
            $details[] = array('sex', $sex);
        }

        $details[] = array('birthday', '<=', date('Y-m-d', strtotime($min . ' years ago')));
        $details[] = array('birthday', '>=', date('Y-m-d', strtotime($max . ' years ago')));

        return Person::where($details)
                    ->join('memberships', function($query) use($membership) {
                        $query->on('people.id', '=', 'memberships.person_id')
                            ->where($membership);
                        })
                    ->orderBy('first_name')
                    ->orderBy('second_name')
                    ->orderBy('third_name')
                    ->orderBy('first_surname')
                    ->orderBy('second_surname')
                    ->with('membership')
                    ->paginate(Person::PAGINATION);
    }

    // static methods for statistics
    public static function totalMembers()
    {
        return Person::where('death_date', null)
                    ->join('memberships', function($query) {
                        $query->on('people.id', '=', 'memberships.person_id')
                            ->where('memberships.member', Person::MEMBER);
                        })
                    ->count();
    }

    public static function distributionBySex()
    {
        $collection = Person::where('death_date', null)
                        ->join('memberships', function($query) {
                            $query->on('people.id', '=', 'memberships.person_id')
                                ->where('memberships.member', Person::MEMBER);
                            })
                        ->select('sex', DB::raw('count(*) as total'))
                        ->groupBy('sex')
                        ->orderBy('sex', 'DESC')
                        ->get();

        $distribution = $collection->map(function ($item) {
            return [$item->sex === 'M' ? 'Hombres' : 'Mujeres', $item->total];
        });

        return $distribution->all();
    }

    public static function distributionByOcupation()
    {
        $total_members = Person::totalMembers();

        $with_ministry = Person::where('death_date', null)
                            ->join('memberships', function($join) {
                                $join->on('people.id', '=', 'memberships.person_id')
                                    ->where('memberships.member', Person::MEMBER);
                                })
                            ->join('privilege_histories', function ($join) {
                                $join->on('privilege_histories.person_id', '=', 'people.id')
                                     ->where(function ($query) {
                                        $query->where('privilege_histories.end_date', null)
                                        ->orWhereDate('privilege_histories.end_date', '>=', date('Y-m-d'));
                                    });
                            })
                            ->count();

        return [['Con privilegio', $with_ministry], ['Sin privilegio', $total_members - $with_ministry]];
    }

    public static function distributionByIllness()
    {
        $total_members = Person::totalMembers();

        $with_illness = Person::where('death_date', null)
                            ->where(function ($query) {
                                $query->whereNotNull('diseases')
                                ->orWhereNotNull('handicaps');
                            })
                            ->count();

        return [['Con dolencias', $with_illness], ['Sin dolencias', $total_members - $with_illness]];
    }
}
