<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Detail_Pesanan;
use App\Produk;
use DB;

class KeuntunganController extends Controller
{
    public function index()
    {
        $keuntungan = Detail_Pesanan::all()->where('status','diterima');
        $total = Detail_Pesanan::all()->where('status','diterima')->sum('total_keuntungan');
        return view('admin.keuntungans.index', compact('keuntungan','total'));        
    }
}