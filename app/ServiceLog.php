<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceLog extends Model
{
    //
    public function areas()
    {
        return $this::hasMany('\App\ServiceLogArea','serviceLog_id','id');
    }
    public function service()
    {
        return $this::belongsTo('\App\Service','service_id');
    }
}
