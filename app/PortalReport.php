<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PortalReport extends Model
{
    //
    public function department()
    {
        return $this::belongsTo('\App\Department','department_id');
    }
    public function branch()
    {
        return $this::belongsTo('\App\Branch','branch_id');
    }
    public function assignedDepartments()
    {
        return $this::hasMany('\App\ReportDepartment','report_id','id');
    }
    public function user()
    {
        return $this::hasOne('\App\User','input_by');
    }
}
