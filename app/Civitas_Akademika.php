<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Request_Penjual;


class Civitas_Akademika extends Model
{
    protected $table = 'civitas_akademika';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'id',
        'nama'  
    ];
    protected $guarded = [];

    public function Request_Penjual(){
        return $this->belongsTo(Request_Penjual::class,'id');
    }
    

}
