<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Poliklinik extends Model
{
    protected $table = 'poliklinik';

    protected $fillable = ['nama', 'gedung'];

    public function rekam_medis(){
        return $this->hasMany('App\Models\Rekam_Medis');
    }   
}
