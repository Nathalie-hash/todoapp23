<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Matiere extends Model
{
    public $timestamps = false;
 
    //
    public function ressources() {
        return $this->hasMany('App\Ressource');
    }

    public function niveau(){
        return $this->belongsTo('App\Niveau');
    }
}
