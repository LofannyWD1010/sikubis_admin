<?php

namespace App\Http\Controllers\Admin;

use App\Civitas_Akademika;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pengguna;
use App\Produk;
use App\Request_Penjual;


class AkunController extends Controller
{
    public function index()
    {
        $pengguna = Request_Penjual::all()->where('status','1');
        $civitas_select = Civitas_Akademika::all()->pluck('nama','id'); 
        return view('admin.akuns.index', compact('pengguna','civitas_select'));
        
    }

    public function show($id_pengguna)
    {
        $produk = Produk::all()->where('id_pengguna',$id_pengguna);
        return view('admin.akuns.show', compact('id_pengguna','produk'));
    }
    public function show_civitas(Request $request)
    {
        $pengguna = Request_Penjual::all()->where('status','1');

        $civitas = $request->id_civitas_akademika;
        $civitas_select = Civitas_Akademika::all()->pluck('nama','id');
        
        $pengguna = $pengguna->where('id_civitas_akademika',$civitas);

        return view('admin.akuns.index', compact('pengguna','civitas','civitas_select'));        
    }

    public function show_civitas_filter($id_civitas_akademika)
    {
        $pengguna = Request_Penjual::all()
        ->where('status','1')
        ->where('id_civitas_akademika',$id_civitas_akademika);
        
        return view('admin.akuns.show_civitas_filter', compact('pengguna'));        
    }


}
