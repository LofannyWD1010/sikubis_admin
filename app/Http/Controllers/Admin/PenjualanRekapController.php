<?php

namespace App\Http\Controllers\Admin;

use App\Detail_Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Fakultas;
use App\Request_Penjual;
use App\Produk;
use DB;

class PenjualanRekapController extends Controller
{
    public function index()
    {
        $rekap = Detail_Pesanan::join('request_mitra', 'detail_pesanan.id_penjual', '=', 'request_mitra.id_pengguna')
		->select('detail_pesanan.id_penjual','detail_pesanan.status','detail_pesanan.total_keuntungan','detail_pesanan.updated_at','request_mitra.id_pengguna','request_mitra.id_fakultas')
        ->where('detail_pesanan.status','diterima')
        ->get();
        $fakultas_select = Fakultas::all()->pluck('nama','id');

        return view('admin.penjualanrekaps.index', compact('rekap','fakultas_select'));
    }

    public function show_range(Request $request)
    {
        $rekap = Detail_Pesanan::join('request_mitra', 'detail_pesanan.id_penjual', '=', 'request_mitra.id_pengguna')
		->select('detail_pesanan.id_penjual','detail_pesanan.status','detail_pesanan.updated_at','detail_pesanan.total_keuntungan','request_mitra.id_pengguna','request_mitra.id_fakultas')
        ->where('detail_pesanan.status','diterima')
        ->get();

        $tanggalawal = Carbon::parse($request->tanggalawal)->format('Y-m-d');
        $tanggalakhir = Carbon::parse($request->tanggalakhir)->format('Y-m-d');
        $fakultas = $request->id_fakultas;
        $fakultas_select = Fakultas::all()->pluck('nama','id');
        
        $rekap = $rekap->whereBetween('updated_at',[$tanggalawal, $tanggalakhir])
        ->where('id_fakultas',$fakultas);
        

        return view('admin.penjualanrekaps.index', compact('tanggalawal','tanggalakhir','rekap','fakultas','fakultas_select'));        
    }
}