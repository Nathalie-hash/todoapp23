<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ressource extends Model
{
    //
    public $timestamp = false;

    public function matiere(){
        return $this->belongsTo('App\Matiere');
    }
    

}
