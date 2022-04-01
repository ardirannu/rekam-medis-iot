<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasien = Pasien::get();
        return view('admin.pasien', ['pasien' => $pasien]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'kode_rekam_medis' => 'required|unique:pasien', 
            'nama' => 'required',
            'jkl' => 'required',
            'email' => 'required|email|unique:pasien',
            'no_hp' => 'required',
            'alamat' => 'required',
        ],

        [
            'kode_rekam_medis.required' => 'Form ini harus diisi !',
            'kode_rekam_medis.unique' => 'ID Rekam Medis sudah terdaftar !',
            'nama.required' => 'Form ini harus diisi !',
            'jkl.required' => 'Form ini harus diisi !',
            'email.required' => 'Form ini harus diisi !',
            'email.email' => 'Format email salah !',
            'email.unique' => 'Email sudah terdaftar !',
            'no_hp.required' => 'Form ini harus diisi !',
            'alamat.required' => 'Form ini harus diisi !',
        ]);
    }

    private function _validation_update(Request $request){
        // validasi inputan dari form
        $validated = $request->validate([
            'nama' => 'required',
            'jkl' => 'required',
            'no_hp' => 'required',
            'alamat' => 'required',
        ],

        [
            'nama.required' => 'Form ini harus diisi !',
            'jkl.required' => 'Form ini harus diisi !',
            'no_hp.required' => 'Form ini harus diisi !',
            'alamat.required' => 'Form ini harus diisi !',
        ]);
    }

    public function store(Request $request)
    {
        $this->_validation($request);
        $current_date_time = Carbon::today()->toDateString();

        $pasien = new Pasien;
        $pasien->kode_rekam_medis = $request->kode_rekam_medis;
        $pasien->nama = $request->nama;
        $pasien->jkl = $request->jkl;
        $pasien->email = $request->email;
        $pasien->no_hp = $request->no_hp;
        $pasien->alamat = $request->alamat;
        $pasien->created_at = $current_date_time;
        $pasien->updated_at = $current_date_time;
        $pasien->save();

        return redirect()->route('pasien.index');
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
        $pasien = Pasien::find($id);
        return view('admin.pasien-edit', ['pasien' => $pasien]);
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
        Pasien::where('id', $id)->update(['kode_rekam_medis' => $request->kode_rekam_medis, 'nama' => $request->nama, 'jkl' => $request->jkl, 'email' => $request->email, 'no_hp' => $request->no_hp, 'alamat' => $request->alamat]);
        return redirect()->route('pasien.index')->with('update_berhasil', 'Update data Berhasil dilakukan.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pasien::destroy($id);
        return redirect()->route('pasien.index');
    }
}
