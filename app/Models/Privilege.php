<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'preferred_sex', 'preferred_status', 'min_age', 'max_age'];

    public function getPreferrencesAttribute()
    {
        $preferrences = $this->preferred_sex ? ($this->preferred_sex == 'M' ? 'Hombre' : 'Mujer') : 'Hombre o mujer';

        if ($this->preferred_status) {
          if ($this->preferred_sex) {
            if ($this->preferred_sex == 'M') {
              $preferrences .= $this->preferred_status == 1 ? ', soltero' : ', casado';
            }
            else {
              $preferrences .= $this->preferred_status == 1 ? ', soltera' : ', casada';
            }
          }
          else {
            if (($this->min_age >= 18 or $this->max_age >= 18 or !$this->max_age)) {
                $preferrences .= $this->preferred_status == 1 ? ', soltero(a)' : ', casado(a)';
            }
          }
        }
        
        if ($this->max_age and $this->min_age) {
          $preferrences .= ', entre ' . $this->min_age . ' y ' . $this->max_age . ' años';
        }
        else if ($this->min_age) {
          $preferrences .= ', a partir de ' . $this->min_age . ' años';
        }

        if ($preferrences == '') {
          $preferrences = 'Abierto a todos los miembros';
        }

        return $preferrences;
    }
}
