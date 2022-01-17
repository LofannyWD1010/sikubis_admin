<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Saldo_Cair;
use App\Pengguna;

class SaldoCairController extends Controller
{
    public function index()
    {
        $saldo_cair = Saldo_Cair::all()->where('status','sudah cair');
        $total= Saldo_Cair::all()->where('status','sudah cair')->sum('saldo');
        return view('admin.saldocairs.index', compact('saldo_cair','total'));
    }
    public function show_range(Request $request)
    {
        $saldo_cair = Saldo_Cair::all()->where('status','sudah cair');
        $total= Saldo_Cair::all()->where('status','sudah cair')->sum('saldo');
        $tanggalawal = Carbon::parse($request->tanggalawal)->format('Y-m-d');
        $tanggalakhir = Carbon::parse($request->tanggalakhir)->format('Y-m-d');
            
        $saldo_cair = $saldo_cair->whereBetween('created_at',[$tanggalawal, $tanggalakhir]);
        return view('admin.saldocairs.index', compact('laporan','saldo_cair','total','tanggalawal','tanggalakhir'));
    }
}
