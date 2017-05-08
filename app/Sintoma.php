<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sintoma extends Model
{
    protected $table = 'sintomas';

    public function enfermedades()
    {
    	return $this->belongsToMany('App\Enfermedad', 'enfermedad_sintomas', 'id', 'id');
    }
}
