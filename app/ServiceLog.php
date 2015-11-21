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

    public function branchAreas()
    {
        return $this::hasMany('\App\ServiceLogBranch','serviceLog_id','id');
    }
    public function departmentAreas()
    {
        return $this::hasMany('\App\ServiceLogDepartment','serviceLog_id','id');
    }
    public function unitAreas()
    {
        return $this::hasMany('\App\ServiceLogUnit','serviceLog_id','id');
    }
}
