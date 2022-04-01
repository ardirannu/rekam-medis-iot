<?php

namespace App\Http\Controllers;

use App\Models\Rfid;
use Illuminate\Http\Request;

class RfidController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'data' => ['required'],
        ]);
        
        Rfid::create([
            'data' => request('data'),
        ]);
    }
}
