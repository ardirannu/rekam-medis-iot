<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Rekam_Medis;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $current_date_time = Carbon::now()->format('Y-m-d 00:00:00');

        $pasien_today = Pasien::where('created_at', $current_date_time)->count();
        $pasien_week = Pasien::where('created_at', '>', Carbon::now()->startOfWeek())->where('created_at', '<', Carbon::now()->endOfWeek())->count();
        $pasien_month = Pasien::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
        $rekam_today = Rekam_Medis::where('created_at', $current_date_time)->count();
        $rekam_week = Rekam_Medis::where('created_at', '>', Carbon::now()->startOfWeek())->where('created_at', '<', Carbon::now()->endOfWeek())->count();
        $rekam_month = Rekam_Medis::where('created_at', '>', Carbon::now()->startOfMonth())->where('created_at', '<', Carbon::now()->endOfMonth())->count();
        
        // $pelanggan = Pelanggan::count();
        // $nomor_terjual = Nomor::where('status', 'Terjual')->count();
        // $penjualan_rupiah = Nomor::where('status', 'Terjual')->sum('harga');
        return view('admin.index', ['pasien_today' => $pasien_today, 'pasien_week' => $pasien_week, 'pasien_month' => $pasien_month, 'rekam_today' => $rekam_today, 'rekam_week' => $rekam_week, 'rekam_month' => $rekam_month]);
    }
}
