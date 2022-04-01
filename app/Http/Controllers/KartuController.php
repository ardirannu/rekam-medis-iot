<?php

namespace App\Http\Controllers;

use App\Models\Kartu_Pasien;
use App\Models\Pasien;
use App\Models\Rfid;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class KartuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        Rfid::truncate();
        $kartu = Kartu_Pasien::get();
        $pasien = Pasien::get();
        return view('admin.kartu_pasien', ['kartu' => $kartu, 'pasien' => $pasien,]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pasien = Pasien::get();
        return view('admin.kartu_pasien_add', ['pasien' => $pasien,]);
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
            'pasien_id' => 'required|unique:kartu_pasien',
            'kode_kartu' => 'required|unique:kartu_pasien',
        ],

        [
            'pasien_id.required' => 'Form ini harus diisi !',
            'pasien_id.unique' => 'Pasien telah memiliki kartu !',
            'kode_kartu.unique' => 'Kartu telah terdaftar !',
            'kode_kartu.required' => 'Form ini harus diisi !',
        ]);
    }

    private function _validation_update(Request $request){
        // validasi inputan dari form
        $validated = $request->validate([
            'kode_kartu' => 'required|unique:kartu_pasien',
        ],

        [
            'kode_kartu.unique' => 'Kartu telah terdaftar !',
            'kode_kartu.required' => 'Form ini harus diisi !',
        ]);
    }

    public function store(Request $request)
    {
        $this->_validation($request);
        Kartu_Pasien::create($request->all());  
        Rfid::truncate();
        return redirect()->route('kartu.index')->with('tambah_berhasil', 'Berhasil Tambah Data.');
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
        $pasien = Pasien::get();
        $kartu = Kartu_Pasien::find($id);
        return view('admin.kartu-edit', ['kartu' => $kartu, 'pasien' => $pasien]);
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
        Kartu_Pasien::where('id', $id)->update(['pasien_id' => $request->pasien_id, 'kode_kartu' => $request->kode_kartu]);
        Rfid::truncate();
        return redirect()->route('kartu.index')->with('update_berhasil', 'Update data Berhasil dilakukan.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Kartu_Pasien::destroy($id);
        return redirect()->route('kartu.index');
    }
 
      //get data rfid
      public function get_rfid()
      {
        // ambil data terbaru
        $rfid = Rfid::latest()->first();
        return view('admin.rfid', ['rfid' => $rfid]);
      }

      //get data rfid
      public function get_rfid_edit()
      {
        // ambil data terbaru
        $rfid = Rfid::latest()->first();
        return view('admin.rfid', ['rfid' => $rfid]);
      }

}
