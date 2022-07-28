<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pesanan;
use App\Pengguna;
use App\Detail_Pesanan;

class PesananAmbilController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::join('detail_pesanan', 'pesanan.id_pesanan', '=', 'detail_pesanan.id_pesanan')
		->select('pesanan.id_pesanan','pesanan.foto','pesanan.total_bayar','detail_pesanan.status')
        ->where('detail_pesanan.status','diambil')
        ->get();

        return view('admin.pesananambils.index', compact('pesanan'));
    }

    public function show($id_pesanan)
    {
        $detail_pesanan = Detail_Pesanan::all()->where('id_pesanan',$id_pesanan);
        
        // return $detail_pesanan;
        return view('admin.pesananambils.show', compact('id_pesanan','detail_pesanan'));
    }


}
