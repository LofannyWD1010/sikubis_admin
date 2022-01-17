<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use App\Pengguna;
use App\Produk;
use App\Detail_Pesanan;
use App\Request_Penjual;
use App\Saldo_Masuk;
use App\Saldo_Cair;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class HomeController
{
    public function index()
    {

        $year = Carbon::now()->format('Y');
		$month = Carbon::now()->format('m');

        $jumlah_mahasiswa = Request_Penjual::all()
        ->where('id_civitas_akademika','2')
		->where('status','sudah')
        ->count();
        $jumlah_dosen = Request_Penjual::all()
        ->where('id_civitas_akademika','1')
		->where('status','sudah')
        ->count();
        $jumlah_tenagaPendidikan = Request_Penjual::all()
        ->where('id_civitas_akademika','3')
		->where('status','sudah')
        ->count();
		$jumlah_requestBelum = Request_Penjual::all()
        ->where('status','belum')
        ->count();

		$jumlah_requestPencairan = Saldo_Cair::all()
        ->where('status','belum cair')
        ->count();


        $jumlah_penjualan_terbanyak = Detail_Pesanan::select('id_penjual')
		->where('status','diterima')
		->groupBy('id_penjual')
		->orderByRaw('COUNT(*) DESC')
		->limit(1)
		->get();
        // ->groupBy('detail_pesanan.id_penjual')
        // ->orderByRaw('COUNT(*) DESC')
        // ->limit(1)
        // $jumlah_penjualan_terbanyak = Detail_Pesanan::join('request_mitra', 'detail_pesanan.id_penjual', '=', 'request_mitra.id_pengguna')
		// ->select('detail_pesanan.id_penjual','detail_pesanan.status','request_mitra.id_pengguna','request_mitra.id_fakultas')
        // ->where('request_mitra.id_fakultas',7)
        // ->groupBy('detail_pesanan.id_penjual')
        // ->orderByRaw('COUNT(*) DESC')
        // ->limit(1)
        // ->get();
		
		
		// $tabel_gabung_fisip = Detail_Pesanan::join('request_mitra', 'detail_pesanan.id_penjual', '=', 'request_mitra.id_pengguna')
        // ->select('detail_pesanan.*', 'request_mitra.id_pengguna', 'request_mitra.id_fakultas')
        // ->where('detail_pesanan.id_penjual',$jumlah_penjualan_terbanyak[0]['id_penjual'])
        // ->where('detail_pesanan.status','diterima')
        // ->where('request_mitra.id_fakultas',6)
		// ->get();

		// $tabel_gabung_fisip = Detail_Pesanan::join('request_mitra', 'detail_pesanan.id_penjual', '=', 'request_mitra.id_pengguna')
        // ->select('detail_pesanan.*', 'request_mitra.id_pengguna', 'request_mitra.id_fakultas')
        // ->where('detail_pesanan.id_penjual',$jumlah_penjualan_terbanyak[0]['id_penjual'])
        // ->where('detail_pesanan.status','diterima')
        // ->where('request_mitra.id_fakultas',6)
		// ->get();

		

		// $tabel_gabung_fmipa = Detail_Pesanan::join('request_mitra', 'detail_pesanan.id_penjual', '=', 'request_mitra.id_pengguna')
        // ->select('detail_pesanan.*', 'request_mitra.id_pengguna', 'request_mitra.id_fakultas')
        // ->where('detail_pesanan.id_penjual',$jumlah_penjualan_terbanyak[0]['id_penjual'])
        // ->where('detail_pesanan.status','diterima')
        // ->where('request_mitra.id_fakultas',7)
		// ->get();

		// return $tabel_gabung_fmipa;
		// $tabel_gabung = DB::table('detail_pesanan')
        // ->join('request_mitra', 'detail_pesanan.id_penjual', '=', 'request_mitra.id_pengguna')
        // ->select('detail_pesanan.*', 'request_mitra.id_pengguna', 'request_mitra.id_fakultas')
        // ->get();

		

		

		// $tabel_gabung = $tabel_gabung->select('id_penjual')
        // ->where('status','diterima')
		// ->where('id_fakultas','7')
        // ->groupBy('id_penjual')
        // ->orderByRaw('COUNT(*) DESC')
        // ->limit(1)
		// ->get();
		
		
		
		

        //Total Pemasukan

        $jan1[] = 0;
		$jan = Saldo_Masuk::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '1')
        ->get();
		for($i=0; $i<count($jan); $i++) {
			$jan1[] = $jan[$i]->saldo;		
		}
		$b1 = array_sum($jan1);

		$feb2[] = 0;
		$feb = Saldo_Masuk::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '2')
        ->get();
		for($i=0; $i<count($feb); $i++) {
			$feb2[] = $feb[$i]->saldo;		
		}
		$b2 = array_sum($feb2);

		$mar3[] = 0;
		$mar = Saldo_Masuk::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '3')
        ->get();
		for($i=0; $i<count($mar); $i++) {
			$mar3[] = $mar[$i]->saldo;		
		}
		$b3 = array_sum($mar3);

		$apr4[] = 0;
		$apr = Saldo_Masuk::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '4')
        ->get();
		for($i=0; $i<count($apr); $i++) {
			$apr4[] = $apr[$i]->saldo;		
		}
		$b4 = array_sum($apr4);
	
		$mei5[] = 0;
		$mei = Saldo_Masuk::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '5')
        ->get();
		for($i=0; $i<count($mei); $i++) {
			$mei5[] = $mei[$i]->saldo;		
		}
		$b5 = array_sum($mei5);

		$jun6[] = 0;
		$jun = Saldo_Masuk::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '6')
        ->get();
		for($i=0; $i<count($jun); $i++) {
			$jun6[] = $jun[$i]->saldo;		
		}
		$b6 = array_sum($jun6);

		$jul7[] = 0;
		$jul = Saldo_Masuk::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '7')
        ->get();
		for($i=0; $i<count($jul); $i++) {
			$jul7[] = $jul[$i]->saldo;		
		}
		$b7 = array_sum($jul7);
	
		$ags8[] = 0;
		$ags = Saldo_Masuk::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '8')
        ->get();
		for($i=0; $i<count($ags); $i++) {
			$ags8[] = $ags[$i]->saldo;		
		}
		$b8 = array_sum($ags8);
		
		$sep9[] = 0;
		$sep = Saldo_Masuk::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '9')
        ->get();
		for($i=0; $i<count($sep); $i++) {
			$sep9[] = $sep[$i]->saldo;		
		}
		$b9 = array_sum($sep9);

		$okt10[] = 0;
		$okt = Saldo_Masuk::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '10')
        ->get();
		for($i=0; $i<count($okt); $i++) {
			$okt10[] = $okt[$i]->saldo;		
		}
		$b10 = array_sum($okt10);

		$nov11[] = 0;
		$nov = Saldo_Masuk::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '11')
        ->get();
		for($i=0; $i<count($nov); $i++) {
			$nov11[] = $nov[$i]->saldo;		
		}
		$b11 = array_sum($nov11);

		$des12[] = 0;
		$des = Saldo_Masuk::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '12')
        ->get();
		for($i=0; $i<count($des); $i++) {
			$des12[] = $des[$i]->saldo;		
		}
		$b12 = array_sum($des12);

		$pemasukan = array($b1,$b2,$b3,$b4,$b5,$b6,$b7,$b8,$b9,$b10,$b11,$b12);

		// BATAS
		//Total Pengeluaran

		$ke_jan1[] = 0;
		$ke_jan = Saldo_Cair::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '1')
        ->get();
		for($i=0; $i<count($ke_jan); $i++) {
			$ke_jan1[] = $ke_jan[$i]->saldo;
		}
		$ke_b1 = array_sum($ke_jan1);

		$ke_feb2[] = 0;
		$ke_feb = Saldo_Cair::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '2')
        ->get();
		for($i=0; $i<count($ke_feb); $i++) {
			$ke_feb2[] = $ke_feb[$i]->saldo;
		}
		$ke_b2 = array_sum($ke_feb2);

		$ke_mar3[] = 0;
		$ke_mar = Saldo_Cair::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '3')
        ->get();
		for($i=0; $i<count($ke_mar); $i++) {
			$ke_mar3[] = $ke_mar[$i]->saldo;
		}
		$ke_b3 = array_sum($ke_mar3);

		$ke_apr4[] = 0;
		$ke_apr = Saldo_Cair::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '4')
        ->get();
		for($i=0; $i<count($ke_apr); $i++) {
			$ke_apr4[] = $ke_apr[$i]->saldo;
		}
		$ke_b4 = array_sum($ke_apr4);

		$ke_mei5[] = 0;
		$ke_mei = Saldo_Cair::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '5')
        ->get();
		for($i=0; $i<count($ke_mei); $i++) {
			$ke_mei5[] = $ke_mei[$i]->saldo;
		}
		$ke_b5 = array_sum($ke_mei5);

		$ke_jun6[] = 0;
		$ke_jun = Saldo_Cair::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '6')
        ->get();
		for($i=0; $i<count($ke_jun); $i++) {
			$ke_jun6[] = $ke_jun[$i]->saldo;
		}
		$ke_b6 = array_sum($ke_jun6);

		$ke_jul7[] = 0;
		$ke_jul = Saldo_Cair::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '7')
        ->get();
		for($i=0; $i<count($ke_jul); $i++) {
			$ke_jul7[] = $ke_jul[$i]->saldo;
		}
		$ke_b7 = array_sum($ke_jul7);

		$ke_ags8[] = 0;
		$ke_ags = Saldo_Cair::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '8')
        ->get();
		for($i=0; $i<count($ke_ags); $i++) {
			$ke_ags8[] = $ke_ags[$i]->saldo;
		}
		$ke_b8 = array_sum($ke_ags8);

		$ke_sep9[] = 0;
		$ke_sep = Saldo_Cair::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '9')
        ->get();
		for($i=0; $i<count($ke_sep); $i++) {
			$ke_sep9[] = $ke_sep[$i]->saldo;
		}
		$ke_b9 = array_sum($ke_sep9);

		$ke_okt10[] = 0;
		$ke_okt = Saldo_Cair::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '10')
        ->get();
		for($i=0; $i<count($ke_okt); $i++) {
			$ke_okt10[] = $ke_okt[$i]->saldo;
		}
		$ke_b10 = array_sum($ke_okt10);

		$ke_nov11[] = 0;
		$ke_nov = Saldo_Cair::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '11')
        ->get();
		for($i=0; $i<count($ke_nov); $i++) {
			$ke_nov11[] = $ke_nov[$i]->saldo;
		}
		$ke_b11 = array_sum($ke_nov11);

		$ke_des12[] = 0;
		$ke_des = Saldo_Cair::whereYear('created_at', '=', $year)
        ->whereMonth('created_at', '=', '12')
        ->get();
		for($i=0; $i<count($ke_des); $i++) {
			$ke_des12[] = $ke_des[$i]->saldo;
		}
		$ke_b12 = array_sum($ke_des12);

		$pengeluaran = array($ke_b1,$ke_b2,$ke_b3,$ke_b4,$ke_b5,$ke_b6,$ke_b7,$ke_b8,$ke_b9,$ke_b10,$ke_b11,$ke_b12);

        $label = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

        return view('home', compact('jumlah_mahasiswa','jumlah_dosen','jumlah_penjualan_terbanyak','jumlah_tenagaPendidikan','jumlah_requestBelum','jumlah_requestPencairan'))
        ->with('pemasukan',json_encode($pemasukan,JSON_NUMERIC_CHECK))
        ->with('pengeluaran',json_encode($pengeluaran,JSON_NUMERIC_CHECK))
        ->with('label',json_encode($label,JSON_NUMERIC_CHECK));
        
        #echo var_dump($jul[0]->saldo);
        
    }
    
}
