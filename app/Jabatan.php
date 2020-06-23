<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    //
    protected $guarded=[];
    
    public function karyawan(){
        return $this->hasMany('App\Karyawan','bagian_id','id');
    }
}
