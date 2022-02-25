<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Produk;
use App\Pengguna;
use App\Detail_Pesanan;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::all();
        return view('admin.produks.index',compact('produk'));
    }
    public function destroy(Request $request, $id)
    {
        Produk::where('id',$id)->delete();
        return back();
    }
}