<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Saldo_Masuk;
use App\Pengguna;
use App\Detail_Pesanan;


class SaldoMasukController extends Controller
{
    public function index()
    {
        $saldo_masuk = Detail_Pesanan::all()->where('status','diterima');
        $total = Detail_Pesanan::all()->where('status','diterima')->sum('total_keuntungan');
        return view('admin.saldomasuks.index',compact('saldo_masuk','total'));
    }
}
