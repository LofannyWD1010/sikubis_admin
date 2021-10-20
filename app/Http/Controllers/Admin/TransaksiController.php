<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pengguna;


class TransaksiController extends Controller
{
    public function index()
    {
        $pengguna = Pengguna::all()->where('status','1');
        $total_kas = 0;
        $total = Pengguna::all()->where('status','1')->sum('saldo');
        return view('admin.transaksis.index', compact('pengguna','total_kas','total'));
    }
}
