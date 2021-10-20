<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\rekap;
use DB;

class SipController extends Controller
{
	public function index(){
    	return view('form');
    }
    public function insert(Request $request){
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
        // DB::table('tb_rekap')->insert([
        // 'id_kab_kota' => $request->id_kab_kota,
        // 'id_penyakit' => $request->id_penyakit,
        // 'tahun' => $request->tahun,
        // 'bulan' => $request->bulan,
        // 'kasus' => $request->kasus,
        // 'jenis_kelamin' => $request->jenis_kelamin,
        // 'a0_7_hari' => $request->inputan_1,
        // 'b8_28_hari' => $request->inputan_2,
        // 'c1_11_bln' => $request->inputan_3,
        // 'd1_4_thn' => $request->inputan_4,
        // 'e5_9_thn' => $request->inputan_5,
        // 'f10_14_thn' => $request->inputan_6,
        // 'g15_19_thn' => $request->inputan_7,
        // 'h20_44_thn' => $request->inputan_8,
        // 'i45_59_thn' => $request->inputan_9,
        // 'j60_thn' => $request->inputan_10,
        // ]);
        rekap::create($request->al());
        return redirect('/laporan');
    }
    }
    public function read(){
        $tb_rekap = rekap::all();
        return view('laporan',compact('tb_rekap'));
        // return $kab_kota;
    }

    public function delete($id){
       DB::table('tb_rekap')->where('id',$id)->delete();
       return redirect('/laporan');
    }
    public function edit($id){
        $tb_rekap = DB::table('tb_rekap')->where('id',$id)->get();
        return view('edit',['tb_rekap' => $tb_rekap]);
    }

    public function update(Request $request,$id){
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
        DB::table('tb_rekap')->where('id',$id)->update([
        'id_kab_kota' => $request->id_kab_kota,
        'id_penyakit' => $request->id_penyakit,
        'tahun' => $request->tahun,
        'bulan' => $request->bulan,
        'kasus' => $request->kasus,
        'jenis_kelamin' => $request->jenis_kelamin,
        'a0_7_hari' => $request->inputan_1,
        'b8_28_hari' => $request->inputan_2,
        'c1_11_bln' => $request->inputan_3,
        'd1_4_thn' => $request->inputan_4,
        'e5_9_thn' => $request->inputan_5,
        'f10_14_thn' => $request->inputan_6,
        'g15_19_thn' => $request->inputan_7,
        'h20_44_thn' => $request->inputan_8,
        'i45_59_thn' => $request->inputan_9,
        'j60_thn' => $request->inputan_10,
    ]);
    return redirect('/laporan');
    }
    }
}
