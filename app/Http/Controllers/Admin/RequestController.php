<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Request_Penjual;
use App\Pengguna;

class RequestController extends Controller
{
    public function index()
    {
        $request_mitra = Request_Penjual::all()->where('status','belum');
        return view('admin.requests.index', compact('request_mitra'));
    }

    public function show($id_pengguna)
    {
        $request_mitra = Request_Penjual::all()->where('id_pengguna',$id_pengguna);
        // return $detail_pesanan;
        return view('admin.requests.show', compact('id_pengguna','request_mitra'));
    }

    public function update_request_penjual($id_pengguna)
    {
        abort_unless(\Gate::allows('product_edit'), 403);

        Request_Penjual::where('id_pengguna',$id_pengguna)->update([
            'status' => 'sudah',

        ]);
        Pengguna::where('id',$id_pengguna)->update([
            'status' => '1',

        ]);
        $request_mitra = Request_Penjual::all()->where('id_pengguna',$id_pengguna);
        // return $detail_pesanan;
        return redirect()->route('admin.requests.index',$id_pengguna);
    }
}
