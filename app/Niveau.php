<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Niveau extends Model
{
    //

    public function matieres() {
        return $this->hasMany('App\Matiere');
    }
}
