<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function campuses()
    {
        return $this->hasMany(Campus::class);
    }

    public function families()
    {
        return $this->hasMany(Family::class);
    }
}
