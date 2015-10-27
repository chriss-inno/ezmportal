<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    //
    public function branch()
    {
        return $this::belongsTo('\App\Branch','branch_id');
    }
    public function units()
    {
        return $this::hasMany('\App\Unit','department_id','id');
    }
    public function module()
    {
        return $this::hasMany('\App\Module','department_id','id');
    }

    public function users()
    {
        return $this::hasMany('\App\User','department_id','id');
    }
    public function queries()
    {
        return $this::hasMany('\App\Query','from_department','id');
    }
    public function reportsAssigned()
    {
        return $this::hasMany('\App\ReportDepartment','department_id','id');
    }
    public function queryEmails()
    {
        return $this::hasMany('\App\QueryEmail','department_id','id');
    }
    public function downloads()
    {
        return $this::hasMany('\App\Download','department_id','id');
    }
}
