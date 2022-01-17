<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Produk;
use App\Request_Penjual;

class Detail_Pesanan extends Model
{
    protected $table = 'detail_pesanan';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id_detail',
        'id_pesanan',
        'id_penjual',
        'id_pembeli',
        'id_produk',
        'harga',
        'ongkir',
        'total_keuntungan',
        'jumlah',
        'alamat_antar',
        'status',
        'ambil',
    ];
    protected $guarded = [];
    
    public function Pengguna(){
        return $this->belongsTo(Pengguna::class,'id_penjual','id');
    }

    public function Pesanan(){
        return $this->belongsTo('App\Pesanan','id_pesanan');
    }

    public function Produk(){
        return $this->belongsTo(Produk::class,'id_produk','id');
    }

    public function Request_Penjual(){
        return $this->belongsTo(Request_Penjual::class,'id_penjual','id')->where('id_fakultas','7');
    }

}
