<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceLogArea extends Model
{
    //
    public function serviceLog()
    {
        return $this::belongsTo('\App\ServiceLog','serviceLog_id');
    }
}
