<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telepon extends Model
{
    //
    protected $guarded=[];
    
    public function karyawan(){
        return $this->belongsTo('App\Karyawan','karyawan_id','id');
    }
}
