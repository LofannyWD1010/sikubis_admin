<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pengguna;
use App\Produk;
use App\Request_Penjual;


class AkunController extends Controller
{
    public function index()
    {
        $pengguna = Pengguna::all()->where('status','1');
        return view('admin.akuns.index', compact('pengguna'));
    }

    public function show($id_pengguna)
    {
        $produk = Produk::all()->where('id_pengguna',$id_pengguna);
        // return $detail_pesanan;
        return view('admin.akuns.show', compact('id_pengguna','produk'));
    }

}
