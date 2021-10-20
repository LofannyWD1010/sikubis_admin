<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Saldo_Masuk;
use App\Saldo_Cair;
use App\Produk;
use App\Request_Penjual;
use App\Detail_Pesanan;

class Pengguna extends Model
{
    protected $table = 'pengguna';

    protected $dates = [
        'created_at',
        'updated_at',
    ];
    
    protected $fillable = [
        'id',
        'nama',
        'no_telp',
        'alamat',
        'daerah',
        'foto',
        'status',
        'saldo'
    ];
    protected $guarded = [];
    public function Saldo_Masuk(){
        return $this->belongsTo(Saldo_Masuk::class,'id');
    }
    public function Saldo_Cair(){
        return $this->belongsTo(Saldo_Cair::class,'id');
    }
    public function Request_Penjual(){
        return $this->belongsTo(Request_Penjual::class,'id','id_pengguna');
    }
    public function Produk(){
        return $this->belongsToMany(Produk::class,'id');
    }
    public function Detail_Pesanan(){
        return $this->belongsTo(Detail_Pesanan::class,'id');
    }
    public static function showRupiah($nilai){
            $hasil_rupiah = "Rp. " . number_format($nilai,2,',','.');
            return $hasil_rupiah;
    }
    public static function tgl_indo($tanggal){
        $bulan = array (
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);
        
        return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
    }
    public static function hari_ini($hari){
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
            break;
            case 'Mon':			
                $hari_ini = "Senin";
            break;
            case 'Tue':
                $hari_ini = "Selasa";
            break;
            case 'Wed':
                $hari_ini = "Rabu";
            break;
            case 'Thu':
                $hari_ini = "Kamis";
            break;
            case 'Fri':
                $hari_ini = "Jum'at";
            break;
            case 'Sat':
                $hari_ini = "Sabtu";
            break;
            default:
                $hari_ini = "Tidak di ketahui";		
            break;
        }
        return $hari_ini;
     
    }
}
