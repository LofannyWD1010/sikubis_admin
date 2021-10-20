<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Pengguna;

class Saldo_Cair extends Model
{
    protected $table = 'saldo_cair';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'id_pengguna',
        'saldo',
        'tanggal_cair',
        'status'
    ];
    protected $guarded = [];
    public function Pengguna(){
        return $this->belongsTo(Pengguna::class,'id_pengguna','id');
    }

    public static function getSaldoCair($tanggal){
        $saldo_cair = Saldo_Cair::where('tanggal_cair',$tanggal)->get();
        // $saldo_cair = Saldo_cair::all();
        return $saldo_cair;
    }
}
