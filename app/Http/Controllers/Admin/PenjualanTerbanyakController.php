<?php

namespace App\Http\Controllers\Admin;

use App\Detail_Pesanan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Fakultas;
use App\Request_Penjual;
use App\Pengguna;
use App\Produk;
use DB;

class PenjualanTerbanyakController extends Controller
{
    public function index()
    {
        $total_pendapatan = Request_Penjual::addSelect(['total_keuntungan' => Detail_Pesanan::selectRaw('sum(total_keuntungan) as total')
        ->whereColumn('id_penjual', 'request_mitra.id_pengguna')
        ->where('status','diterima')
        ->groupBy('id_penjual')])
        ->orderBy('total_keuntungan', 'DESC')
        ->where('status','1')
        ->get();
        $fakultas_select = Fakultas::all()->pluck('nama','id');

        return view('admin.penjualanterbanyaks.index', compact('total_pendapatan','fakultas_select'));
    }
    public function show_range(Request $request)
    {
        $total_pendapatan = Request_Penjual::addSelect(['total_keuntungan' => Detail_Pesanan::selectRaw('sum(total_keuntungan) as total')
        ->whereColumn('id_penjual', 'request_mitra.id_pengguna')
        ->where('status','diterima')
        ->groupBy('id_penjual')])
        ->orderBy('total_keuntungan', 'DESC')
        ->where('status','1')
        ->get();

        $tanggalawal = Carbon::parse($request->tanggalawal)->format('Y-m-d');
        $tanggalakhir = Carbon::parse($request->tanggalakhir)->format('Y-m-d');
        $fakultas = $request->id_fakultas;
        $fakultas_select = Fakultas::all()->pluck('nama','id');
        
        $total_pendapatan = $total_pendapatan->whereBetween('pengguna.created_at',[$tanggalawal, $tanggalakhir])
        ->where('id_fakultas',$fakultas);
        

        return view('admin.penjualanterbanyaks.index', compact('tanggalawal','tanggalakhir','total_pendapatan','fakultas','fakultas_select'));        
    }
    public function show($id_pengguna)
    {

        $riwayat_penjualan = Request_Penjual::join('detail_pesanan','detail_pesanan.id_penjual','=','request_mitra.id_pengguna')
        ->select('request_mitra.id_pengguna','request_mitra.id_fakultas','detail_pesanan.total_keuntungan','detail_pesanan.status','detail_pesanan.updated_at')
        ->where('request_mitra.id_pengguna',$id_pengguna)
        ->where('detail_pesanan.status','diterima')
        ->get();
        
        return view('admin.penjualanterbanyaks.show', compact('id_pengguna','riwayat_penjualan'));
    }

}
