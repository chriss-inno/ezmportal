<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    public function serviceLog()
    {
        return $this::hasMany('\App\ServiceLog','service_id','id');
    }
}
