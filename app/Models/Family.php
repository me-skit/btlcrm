<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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

    public function setFamilyNameAttribute($value)
    {
        $this->attributes['family_name'] = ucwords(mb_strtolower($value));
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

    // static methods for statistics
    public static function total()
    {
        return Family::where('active', 1)->count();
    }

    public static function distributionByZone()
    {
        $collection = Family::groupBy('zone')->select('zone', DB::raw('count(*) as total'))->get();

        $distribution = $collection->map(function ($item) {
            return ['Zona ' . $item->zone, $item->total];
        });

        return $distribution->all();
    }
}
