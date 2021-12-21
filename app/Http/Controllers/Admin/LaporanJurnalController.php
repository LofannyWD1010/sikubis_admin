<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Saldo_Masuk;
use App\Saldo_Cair;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;


class LaporanJurnalController extends Controller
{
    public function index()
    {
        $tanggalawal = Carbon::now()->startOfMonth()->format('Y-m-d');
        $tanggalakhir = Carbon::now()->endOfMonth()->format('Y-m-d');
        $period = CarbonPeriod::create($tanggalawal,$tanggalakhir);

        $pemasukan = DB::table("saldo_masuk")
        ->select(DB::raw("created_at , saldo_masuk.saldo as 'saldo_masuk', saldo_masuk.id_pesanan as 'status' "))
        ->get();
        $pengeluaran = DB::table("saldo_cair")
        ->select(DB::raw("created_at , saldo_cair.saldo as 'saldo_cair', status"))
        ->get();
        $laporan = $pemasukan->merge($pengeluaran)->sortBy('created_at');
                   
        //dd($kategori);
        return view('admin.laporanjurnals.index', compact('period','tanggalawal','tanggalakhir','laporan'));        
    }
    public function show_range(Request $request)
    {
        $tanggalawal = Carbon::parse($request->tanggalawal)->format('Y-m-d');
        $tanggalakhir = Carbon::parse($request->tanggalakhir)->format('Y-m-d');
        $period = CarbonPeriod::create($tanggalawal,$tanggalakhir);
        // return $period;
        return view('admin.laporanjurnals.index', compact('tanggalawal','tanggalakhir','period'));        
    }
    public function show_weekly()
    {
        $tanggalawal = Carbon::now()->startOfWeek()->format('Y-m-d');
        $tanggalakhir = Carbon::now()->endOfWeek()->format('Y-m-d');
        $period = CarbonPeriod::create($tanggalawal,$tanggalakhir);
        // return $period;
        return view('admin.laporanjurnals.index', compact('period','tanggalawal','tanggalakhir'));        
    }

    public function show_date(Request $request){
        $pemasukan = DB::table("saldo_masuk")
        ->select(DB::raw("created_at , saldo_masuk.saldo as 'saldo_masuk', saldo_masuk.id_pesanan as 'status' "))
        ->get();
        $pengeluaran = DB::table("saldo_cair")
        ->select(DB::raw("created_at , saldo_cair.saldo as 'saldo_cair', status"))
        ->get();
        $laporan = $pemasukan->merge($pengeluaran)->sortBy('created_at');
        
        $start_date = Carbon::parse($request->start_date)
        ->toDateTimeString();

        $end_date = Carbon::parse($request->end_date)
        ->toDateTimeString();

        $laporan->whereBetween('created_at',[$start_date,$end_date]);

        return view('admin.laporanjurnals.index', compact('start_date','end_date','laporan'));

    }
}