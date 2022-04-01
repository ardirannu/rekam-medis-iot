<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $role = User::find(1)->role->id;
        // return $role;
        // $role = User::with('role')->get();
        // return $role;
        $role = Role::get();
        $user = User::get(); //send data nomor to nomor.index for input form
        return view('admin/user', ['user' => $user, 'role' => $role,]);
    }

    private function _validation(Request $request){
        // validasi inputan dari form
        $validated = $request->validate([
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:7|regex:/[A-Z]/|regex:/[0-9]/',
        ],

        [
            'role_id.required' => 'Form ini harus diisi !',
            'name.required' => 'Form ini harus diisi !',
            'email.required' => 'Form ini harus diisi !',
            'email.email' => 'Format email salah !',
            'password.required' => 'Form ini harus diisi !',
            'password.min' => 'Minimal 7 karakter !',
            'password.regex' => 'Format password salah ! | Masukkan minimal satu huruf besar dan satu digit angka !',
        ]);
    }

    private function _validation_update(Request $request){
        // validasi inputan dari form
        $validated = $request->validate([
            'role_id' => 'required',
            'name' => 'required',
            'email' => 'required|email',
        ],

        [
            'role_id.required' => 'Form ini harus diisi !',
            'name.required' => 'Form ini harus diisi !',
            'email.required' => 'Form ini harus diisi !',
            'email.email' => 'Format email salah !',
        ]);
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
    public function store(Request $request)
    {
        $this->_validation($request);
    
        User::create(['role_id' => $request->role_id, 'name' => $request->name, 'email' => $request->email, 'password' => bcrypt($request->password),]);  
        
        return redirect()->route('user.index');
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
        $role = Role::get();
        $user = User::find($id);
        return view('admin.user-edit', ['user' => $user, 'role' => $role,]);
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
        
        User::where('id', $id)->update(['role_id' => $request->role_id, 'name' => $request->name, 'email' => $request->email, ]);
    
    } 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('user.index');
    }
}
