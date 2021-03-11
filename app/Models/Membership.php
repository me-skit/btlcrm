<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
}
