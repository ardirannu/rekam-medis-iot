<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rekam_Medis extends Model
{ 
    protected $table = 'rekam_medis';

    protected $fillable = ['kartu_pasien_id', 'keluhan', 'dokter_id', 'diagnosa', 'obat_id', 'poli_id', 'tgl_periksa'];

    public function kartu_pasien(){
        return $this->belongsTo('App\Models\Kartu_Pasien');     
    }  
    
    public function poliklinik(){
        return $this->belongsTo('App\Models\Poliklinik'); 
    }  
    public function obat(){
        return $this->belongsTo('App\Models\Obat'); 
    }  
    public function dokter(){
        return $this->belongsTo('App\Models\Dokter'); 
    }  
}
