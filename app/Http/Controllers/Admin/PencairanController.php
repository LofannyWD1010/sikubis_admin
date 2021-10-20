<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pengguna;
use App\Saldo_Masuk;
use App\Saldo_Cair;

class PencairanController extends Controller
{
    public function index()
    {
        $saldo_cair = Saldo_Cair::where('status','belum cair')->get();
        // return $saldo_cair;
        return view('admin.pencairans.index', compact('saldo_cair'));
    }

    public function update_saldo_cair($id)
    {
        abort_unless(\Gate::allows('product_edit'), 403);

        Saldo_Cair::where('id',$id)->update([
            'status' => 'sudah cair',
        ]);
        $saldo_cair = Saldo_Cair::all()->where('id',$id);
        // return $detail_pesanan;
        return redirect()->route('admin.pencairans.index',$id);
    }
}
