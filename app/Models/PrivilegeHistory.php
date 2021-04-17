<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PrivilegeHistory extends Pivot
{
    use HasFactory;

    protected $table = 'privilege_histories';

    protected $fillable = [
        'person_id',
        'privilege_id',
        'privilege_role_id',
        'start_date',
        'end_date'
    ];

    public function role()
    {
        return $this->belongsTo(PrivilegeRole::class, 'privilege_role_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function getIsActiveAttribute()
    {
        return $this->end_date ? ($this->end_date < date("Y-m-d") ? false : true) : true;
    }
}
