<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kartu_Pasien extends Model
{
    protected $table = 'kartu_pasien';

    protected $fillable = ['pasien_id','kode_kartu',]; 

    public function pasien(){
        return $this->belongsTo('App\Models\Pasien'); 
    }  

    public function rekam_medis(){
        return $this->hasMany('App\Models\Rekam_Medis'); 
    }  
}
