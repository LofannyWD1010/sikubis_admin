<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Fakultas;
use App\Request_Penjual;
use App\Produk;

class PenjualanTerbanyakController extends Controller
{
    public function index()
    {
        $fakultas = Fakultas::all();
        return view('admin.penjualanterbanyaks.index', compact('fakultas'));
    }
    public function detail($id)
    {
        $mitra = Request_Penjual::join('detail_pesanan','detail_pesanan.id_penjual','=','request_mitra.id_pengguna')
        ->select('detail_pesanan.*','request_mitra.id_pengguna','request_mitra.id_fakultas')
        ->where('request_mitra.id_fakultas',$id)
        ->where('detail_pesanan.status','diterima')
        ->get();
        $fakultas = Fakultas::find($id);
        

        return view('admin.penjualanterbanyaks.detail', compact('mitra','fakultas'));
    }
    public function show_range(Request $request,$id)
    {

        $mitra = Request_Penjual::join('detail_pesanan','detail_pesanan.id_penjual','=','request_mitra.id_pengguna')
        ->select('detail_pesanan.*','request_mitra.id_pengguna','request_mitra.id_fakultas')
        ->where('request_mitra.id_fakultas',$id)
        ->where('detail_pesanan.status','diterima')
        ->get();
        $fakultas = Fakultas::find($id);

        $tanggalawal = Carbon::parse($request->tanggalawal)->format('Y-m-d');
        $tanggalakhir = Carbon::parse($request->tanggalakhir)->format('Y-m-d');
            
        $mitra = $mitra->whereBetween('created_at',[$tanggalawal, $tanggalakhir]);

        return view('admin.penjualanterbanyaks.detail', compact('tanggalawal','tanggalakhir','mitra','fakultas'));        
    }

}
