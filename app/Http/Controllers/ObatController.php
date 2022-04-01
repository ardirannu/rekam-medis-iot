<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $obat = Obat::get();
        return view('admin.obat', ['obat' => $obat]);
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
            'harga' => 'required',
            'keterangan' => 'required',
        ],

        [
            'nama.required' => 'Form ini harus diisi !',
            'harga.required' => 'Form ini harus diisi !',
            'keterangan.required' => 'Form ini harus diisi !',
        ]);
    }

    public function store(Request $request)
    {
        $this->_validation($request);
        Obat::create($request->all());  
        return redirect()->route('obat.index');
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
        $obat = Obat::find($id);
        return view('admin.obat-edit', ['obat' => $obat]);
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
        Obat::where('id', $id)->update(['nama' => $request->nama, 'harga' => $request->harga, 'keterangan' => $request->keterangan]);
        return redirect()->route('obat.index')->with('update_berhasil', 'Update data Berhasil dilakukan.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Obat::destroy($id);
        return redirect()->route('obat.index');
    }
}
