<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Saldo_Masuk;
use App\Saldo_Cair;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;

class LaporanPemasukanController extends Controller
{
    public function index()
    {
        $tanggalawal = Carbon::now()->startOfMonth()->format('Y-m-d');
        $tanggalakhir = Carbon::now()->endOfMonth()->format('Y-m-d');
        $period = CarbonPeriod::create($tanggalawal,$tanggalakhir);
        // return $period;
        return view('admin.laporanpemasukans.index', compact('period','tanggalawal','tanggalakhir'));        
    }
    public function show_range(Request $request)
    {
        $tanggalawal = Carbon::parse($request->tanggalawal)->format('Y-m-d');
        $tanggalakhir = Carbon::parse($request->tanggalakhir)->format('Y-m-d');
        $period = CarbonPeriod::create($tanggalawal,$tanggalakhir);
        // return $period;
        return view('admin.laporanpemasukans.index', compact('tanggalawal','tanggalakhir','period'));        
    }
    public function show_weekly()
    {
        $tanggalawal = Carbon::now()->startOfWeek()->format('Y-m-d');
        $tanggalakhir = Carbon::now()->endOfWeek()->format('Y-m-d');
        $period = CarbonPeriod::create($tanggalawal,$tanggalakhir);
        // return $period;
        return view('admin.laporanpemasukans.index', compact('period','tanggalawal','tanggalakhir'));        
    }

}