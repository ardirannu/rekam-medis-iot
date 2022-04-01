<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $table = 'obat';

    protected $fillable = ['nama', 'harga', 'keterangan'];

    public function rekam_medis(){
        return $this->hasMany('App\Models\Rekam_Medis');
    } 
}
