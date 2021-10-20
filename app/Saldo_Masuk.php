<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pengguna;

class Saldo_Masuk extends Model
{
    protected $table = 'saldo_masuk';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'id_pesanan',
        'id_pengguna',
        'tanggal_masuk',
        'saldo'
    ];
    protected $guarded = [];
    public function Pengguna(){
        return $this->belongsTo(Pengguna::class,'id_pengguna','id');
    }
    public static function getSaldoMasuk($tanggal){
        $saldo_masuk = Saldo_Masuk::where('tanggal_masuk',$tanggal)->get();
        // $saldo_masuk = Saldo_Masuk::all();
        return $saldo_masuk;
    }
}
