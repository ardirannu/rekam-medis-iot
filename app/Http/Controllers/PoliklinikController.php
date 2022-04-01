<?php

namespace App\Http\Controllers;

use App\Models\Poliklinik;
use Illuminate\Http\Request;

class PoliklinikController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poli = Poliklinik::get();
        return view('admin.poliklinik', ['poli' => $poli]);
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
            'gedung' => 'required',
        ],

        [
            'nama.required' => 'Form ini harus diisi !',
            'gedung.required' => 'Form ini harus diisi !',
        ]);
    }

    public function store(Request $request)
    {
        $this->_validation($request);
        Poliklinik::create($request->all());  
        return redirect()->route('poliklinik.index');
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
        $poli = Poliklinik::find($id);
        return view('admin.poli-edit', ['poli' => $poli]);
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
        Poliklinik::where('id', $id)->update(['nama' => $request->nama, 'gedung' => $request->gedung]);
        return redirect()->route('poliklinik.index')->with('update_berhasil', 'Update data Berhasil dilakukan.'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Poliklinik::destroy($id);
        return redirect()->route('poliklinik.index');
    }
}
