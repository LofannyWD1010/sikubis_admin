<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Produk;

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

}
