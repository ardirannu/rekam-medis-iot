<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    protected $table = 'dokter';

    protected $fillable = ['nama', 'spesialis', 'email', 'no_hp', 'alamat'];

    public function rekam_medis(){
        return $this->hasMany('App\Models\Rekam_Medis');
    } 
}
