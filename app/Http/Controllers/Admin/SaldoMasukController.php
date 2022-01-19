<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Saldo_Masuk;
use App\Pengguna;
use App\Detail_Pesanan;


class SaldoMasukController extends Controller
{
    public function index()
    {
        $saldo_masuk = Detail_Pesanan::all()->where('status','diterima');
        $total = Detail_Pesanan::all()->where('status','diterima')->sum('total_keuntungan');
        return view('admin.saldomasuks.index',compact('saldo_masuk','total'));
    }
    public function show_range(Request $request)
    {
        $saldo_masuk = Detail_Pesanan::all()->where('status','diterima');
        $total = Detail_Pesanan::all()->where('status','diterima')->sum('total_keuntungan');
        $tanggalawal = Carbon::parse($request->tanggalawal)->format('Y-m-d');
        $tanggalakhir = Carbon::parse($request->tanggalakhir)->format('Y-m-d');
            
        $saldo_masuk = $saldo_masuk->whereBetween('created_at',[$tanggalawal, $tanggalakhir]);
        return view('admin.saldomasuks.index', compact('saldo_masuk','total','tanggalawal','tanggalakhir'));
    }
}
