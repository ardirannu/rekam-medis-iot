<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Kartu_Pasien;
use App\Models\Obat;
use App\Models\Poliklinik;
use App\Models\Rekam_Medis;
use App\Models\Rfid;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekamController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Rfid::truncate();
        $rekam = Rekam_Medis::get();
        return view('admin.rekam_medis', ['rekam' => $rekam]);
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.rekam_medis_rfid',);
    }

    public function create_rfid() 
    {
        $rfid_check = Rfid::latest()->first();
        $dokter = Dokter::get();
        $kartu_pasien = Kartu_Pasien::get();
        $obat = Obat::get();
        $poli = Poliklinik::get();
        return view('admin.rekam_medis_add', ['rfid_check' => $rfid_check, 'dokter' => $dokter, 'kartu_pasien' => $kartu_pasien, 'obat' => $obat, 'poli' => $poli]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function _validation(Request $request){
        // validasi inputan dari form
        $validated = $request->validate([
            'kartu_pasien_id' => 'required',
            'dokter_id' => 'required',
            'keluhan' => 'required',
            'diagnosa' => 'required',
            'poliklinik_id' => 'required',
            'tgl_periksa' => 'required',
        ],

        [
            'kartu_pasien_id.required' => 'Form ini harus diisi !',
            'dokter_id.required' => 'Form ini harus diisi !',
            'keluhan.required' => 'Form ini harus diisi !',
            'diagnosa.required' => 'Form ini harus diisi !',
            'poliklinik_id.required' => 'Form ini harus diisi !',
            'tgl_periksa.required' => 'Form ini harus diisi !',
        ]);
    }

    private function _validation_update(Request $request){
        // validasi inputan dari form
        $validated = $request->validate([
            'dokter_id' => 'required',
            'keluhan' => 'required',
            'diagnosa' => 'required',
            'poliklinik_id' => 'required',
            'tgl_periksa' => 'required',
        ],

        [
            'dokter_id.required' => 'Form ini harus diisi !',
            'keluhan.required' => 'Form ini harus diisi !',
            'diagnosa.required' => 'Form ini harus diisi !',
            'poliklinik_id.required' => 'Form ini harus diisi !',
            'tgl_periksa.required' => 'Form ini harus diisi !',
        ]);
    }

    public function store(Request $request)
    {
        $current_date_time = Carbon::today()->toDateString();
        $this->_validation($request);

        //delete data id rfid yg baru terinput pada tabel rfid
        Rfid::truncate();

        $rekam = new Rekam_Medis;
        $rekam->kartu_pasien_id = $request->kartu_pasien_id;
        $rekam->dokter_id = $request->dokter_id;
        $rekam->keluhan = $request->keluhan; 
        $rekam->diagnosa = $request->diagnosa;
        $rekam->obat_id =  json_encode($request->obat_id);
        $rekam->poliklinik_id = $request->poliklinik_id;
        $rekam->tgl_periksa = $request->tgl_periksa;
        $rekam->created_at = $current_date_time;
        $rekam->updated_at = $current_date_time;
        
        $rekam->save();
        return redirect()->route('rekam_medis.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dokter = Dokter::get();
        $kartu_pasien = Kartu_Pasien::get();
        $obat = Obat::get();
        $poli = Poliklinik::get();
        $rekam = Rekam_Medis::find($id);

        return view('admin.rekam_medis_edit', ['rekam' => $rekam, 'dokter' => $dokter, 'kartu_pasien' => $kartu_pasien, 'obat' => $obat, 'poli' => $poli]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->_validation_update($request);
        Rekam_Medis::where('id', $id)->update(['dokter_id' => $request->dokter_id, 'keluhan' => $request->keluhan, 'diagnosa' => $request->diagnosa, 'keluhan' => $request->keluhan, 'obat_id' => json_encode($request->obat_id), 'poliklinik_id' => $request->poliklinik_id, 'tgl_periksa' => $request->tgl_periksa]);
        Rfid::truncate();
        return redirect()->route('rekam_medis.index')->with('update_berhasil', 'Update data Berhasil dilakukan.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rekam_Medis::destroy($id);
        return redirect()->route('rekam_medis.index');
    }
}
