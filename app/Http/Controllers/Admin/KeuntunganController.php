<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Detail_Pesanan;
use App\Produk;
use DB;
use Carbon\Carbon;

class KeuntunganController extends Controller
{
    public function index()
    {
        $keuntungan = Detail_Pesanan::all()->where('status','diterima');
        $total = Detail_Pesanan::all()->where('status','diterima')->sum('total_keuntungan');
        return view('admin.keuntungans.index', compact('keuntungan','total'));        
    }
    public function show_range(Request $request)
    {
        $keuntungan = Detail_Pesanan::all()->where('status','diterima');
        $total = Detail_Pesanan::all()->where('status','diterima')->sum('total_keuntungan');
        $tanggalawal = Carbon::parse($request->tanggalawal)->format('Y-m-d');
        $tanggalakhir = Carbon::parse($request->tanggalakhir)->format('Y-m-d');
            
        $keuntungan = $keuntungan->whereBetween('created_at',[$tanggalawal, $tanggalakhir]);
        return view('admin.keuntungans.index', compact('keuntungan','total','tanggalawal','tanggalakhir'));
    }
}