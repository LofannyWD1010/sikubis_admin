<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Saldo_Cair;
use App\Pengguna;

class SaldoCairController extends Controller
{
    public function index()
    {
        $saldo_cair = Saldo_Cair::all()->where('status','sudah cair');
        $total= Saldo_Cair::all()->where('status','sudah cair')->sum('saldo');
        return view('admin.saldocairs.index', compact('saldo_cair','total'));
    }
}
