<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pesanan;
use App\Pengguna;
use App\Detail_Pesanan;

class PesananRekapController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::all()
        ->where('status','lunas');
        return view('admin.pesananrekaps.index', compact('pesanan'));
    }

    public function show($id_pesanan)
    {
        $detail_pesanan = Detail_Pesanan::all()->where('id_pesanan',$id_pesanan);
        
        // return $detail_pesanan;
        return view('admin.pesananrekaps.show', compact('id_pesanan','detail_pesanan'));
    }

}
