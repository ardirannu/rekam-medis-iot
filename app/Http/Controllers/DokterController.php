<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokter = Dokter::get();
        return view('admin.dokter', ['dokter' => $dokter]);
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
            'nama' => 'required',
            'spesialis' => 'required',
            'email' => 'required|email|unique:pasien',
            'no_hp' => 'required',
            'alamat' => 'required',
        ],

        [
            'nama.required' => 'Form ini harus diisi !',
            'spesialis.required' => 'Form ini harus diisi !',
            'email.required' => 'Form ini harus diisi !',
            'email.email' => 'Format email salah !',
            'email.unique' => 'Email sudah terdaftar !',
            'no_hp.required' => 'Form ini harus diisi !',
            'alamat.required' => 'Form ini harus diisi !',
        ]);
    }

    public function store(Request $request)
    {
        $this->_validation($request);
        Dokter::create($request->all());  
        return redirect()->route('dokter.index');
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
        $dokter = Dokter::find($id);
        return view('admin.dokter-edit', ['dokter' => $dokter]);
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
        $this->_validation($request);
        Dokter::where('id', $id)->update(['nama' => $request->nama, 'spesialis' => $request->spesialis, 'email' => $request->email, 'no_hp' => $request->no_hp, 'alamat' => $request->alamat]);
        return redirect()->route('dokter.index')->with('update_berhasil', 'Update data Berhasil dilakukan.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Dokter::destroy($id);
        return redirect()->route('dokter.index');
    }
}
