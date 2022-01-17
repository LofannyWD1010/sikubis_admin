<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Saldo_Masuk;
use App\Saldo_Cair;
use App\Detail_Pesanan;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DB;


class LaporanJurnalController extends Controller
{
    public function index()
    {
        

        $pemasukan = DB::table("detail_pesanan")
        ->select(DB::raw("created_at , detail_pesanan.total_keuntungan as 'saldo_masuk', detail_pesanan.id_pesanan as 'status' "))
        ->where('status','diterima')
        ->get();
        $pengeluaran = DB::table("saldo_cair")
        ->select(DB::raw("created_at , saldo_cair.saldo as 'saldo_cair', status"))
        ->get();
        $laporan = $pemasukan->merge($pengeluaran)->sortBy('created_at');

                 
        //dd($kategori);
        return view('admin.laporanjurnals.index', compact('laporan'));        
    }
    public function show_range(Request $request)
    {
        $pemasukan = DB::table("detail_pesanan")
        ->select(DB::raw("created_at , detail_pesanan.total_keuntungan as 'saldo_masuk', detail_pesanan.id_pesanan as 'status' "))
        ->where('status','diterima')
        ->get();
        $pengeluaran = DB::table("saldo_cair")
        ->select(DB::raw("created_at , saldo_cair.saldo as 'saldo_cair', status"))
        ->get();
        $laporan = $pemasukan->merge($pengeluaran)->sortBy('created_at');
     

        $tanggalawal = Carbon::parse($request->tanggalawal)->format('Y-m-d');
        $tanggalakhir = Carbon::parse($request->tanggalakhir)->format('Y-m-d');
            
        $laporan = $laporan->whereBetween('created_at',[$tanggalawal, $tanggalakhir]);
        //dd($period);
        
        
        // return $period;
        return view('admin.laporanjurnals.index', compact('tanggalawal','tanggalakhir','laporan','period'));        
    }
    public function show_weekly()
    {
        $tanggalawal = Carbon::now()->startOfWeek()->format('Y-m-d');
        $tanggalakhir = Carbon::now()->endOfWeek()->format('Y-m-d');
        $period = CarbonPeriod::create($tanggalawal,$tanggalakhir);
        // return $period;
        return view('admin.laporanjurnals.index', compact('period','tanggalawal','tanggalakhir'));        
    }
}