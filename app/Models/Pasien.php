<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $table = 'pasien';

    protected $fillable = ['kode_rekam_medis', 'nama', 'jkl', 'email', 'no_hp', 'alamat'];

    public function kartu_pasien(){
        return $this->hasOne('App\Models\Kartu_Pasien');
    }   
}
