<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pesanan;
use App\Pengguna;
use App\Detail_Pesanan;

class PesananController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::all();//->where('status','lunas');
        return view('admin.pesanans.index', compact('pesanan'));
    }

    public function show($id_pesanan)
    {
        $detail_pesanan = Detail_Pesanan::all()->where('id_pesanan',$id_pesanan);
        
        // return $detail_pesanan;
        return view('admin.pesanans.show', compact('id_pesanan','detail_pesanan'));
    }
    public function update_detail_pesanan($id_pesanan)
    {
        abort_unless(\Gate::allows('product_edit'), 403);

        Detail_Pesanan::where('id_pesanan',$id_pesanan)->update([
            'status' => 'diproses',
        ]);
        $detail_pesanan = Detail_Pesanan::all()->where('id_pesanan',$id_pesanan);
        // return $detail_pesanan;
        return redirect()->route('admin.pesanans.show',$id_pesanan);
    }


}
