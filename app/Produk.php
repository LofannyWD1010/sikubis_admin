<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'id_pengguna',
        'nama',
        'jenis',
        'harga',
        'satuan',
        'status',
        'kategori',
        'lokasi',
        'foto',
        'foto2',
        'foto3',
        'deskripsi',
        'iklan',
        'minimum',
        'berat',
        'stok',
    ];
    protected $guarded = [];
    
    public function Pengguna(){
        return $this->belongsTo(Pengguna::class,'id_pengguna','id');
    }
    public function Detail_Pesanan(){
        return $this->belongsToMany(Detail_Pesanan::class,'id_produk','id');
    }

}
