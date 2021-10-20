<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\rekap;
use App\kab_kota;
use App\penyakit;

class SipsController extends Controller
{
    public function index()
    {
        $tb_rekaps = rekap::all();
        return view('admin.laporans.index', compact('tb_rekaps'));
    }
    public function create(Request $request)
    {
        $kab_kota_select = kab_kota::all()->pluck('nama_kab_kota','id');
        $id_penyakit_select = penyakit::all()->pluck('nama_penyakit','kode_penyakit');
        return view('admin.laporans.create',compact('kab_kota_select','id_penyakit_select'));
    }
    public function store(Request $request)
    {
        $kab_kota = $request->id_kab_kota;
        $penyakit = $request->id_penyakit;
        $tahun = $request->tahun;
        $bulan = $request->bulan;
        $kasus = $request->kasus;
        $jenis_kelamin = $request->jenis_kelamin;
        $rule_1 = rekap::where('id_kab_kota',$kab_kota)->where('id_penyakit',$penyakit)->where('tahun',$tahun)->where('bulan',$bulan)->where('kasus',$kasus)->where('jenis_kelamin',$jenis_kelamin)->count();
        if($rule_1 == 1){
            return redirect()->back()->with('error','Data sudah ada');
        }
        else{
            rekap::create([
                'id_kab_kota' => $request->id_kab_kota,
                'id_penyakit' => $request->id_penyakit,
                'tahun' => $request->tahun,
                'bulan' => $request->bulan,
                'kasus' => $request->kasus,
                'jenis_kelamin' => $request->jenis_kelamin,
                'hari_0_7' => $request->hari_0_7,
                'hari_8_28' => $request->hari_8_28,
                'bulan_1_11' => $request->bulan_1_11,
                'tahun_1_4' => $request->tahun_1_4,
                'tahun_5_9' => $request->tahun_5_9,
                'tahun_10_14' => $request->tahun_10_14,
                'tahun_15_19' => $request->tahun_15_19,
                'tahun_20_44' => $request->tahun_20_44,
                'tahun_45_59' => $request->tahun_45_59,
                'tahun_60' => $request->tahun_60,]); 
            $kab_kota_select = kab_kota::all()->pluck('nama_kab_kota','id');
            return redirect()->route('admin.laporans.index');
        }
    }
    public function show($id)
    {
        $tb_rekap = rekap::all();
        return view('laporans',compact('tb_rekaps'));
    }
    
    public function edit($id)
    {
        $tb_rekap = rekap::find($id);
        $kab_kota_select = kab_kota::all()->pluck('nama_kab_kota','id');
        $id_penyakit_select = penyakit::all()->pluck('nama_penyakit','kode_penyakit');
        return view('admin.laporans.edit',compact('tb_rekap','kab_kota_select','id_penyakit_select'));
    }
    public function update(Request $request, $id)
    {
            rekap::where('id',$id)->update([
            'id_kab_kota' => $request->id_kab_kota,
            'id_penyakit' => $request->id_penyakit,
            'tahun' => $request->tahun,
            'bulan' => $request->bulan,
            'kasus' => $request->kasus,
            'jenis_kelamin' => $request->jenis_kelamin,
            'hari_0_7' => $request->hari_0_7,
            'hari_8_28' => $request->hari_8_28,
            'bulan_1_11' => $request->bulan_1_11,
            'tahun_1_4' => $request->tahun_1_4,
            'tahun_5_9' => $request->tahun_5_9,
            'tahun_10_14' => $request->tahun_10_14,
            'tahun_15_19' => $request->tahun_15_19,
            'tahun_20_44' => $request->tahun_20_44,
            'tahun_45_59' => $request->tahun_45_59,
            'tahun_60' => $request->tahun_60,]);
            return redirect()->route('admin.laporans.index');
            
        
    }
    public function destroy(Request $request, $id)
    {
        rekap::where('id',$id)->delete();
        return back();
    }
}
