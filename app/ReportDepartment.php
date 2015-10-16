<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportDepartment extends Model
{
    //
    public function report()
    {
        return $this::belongsTo('\App\PortalReport','report_id');
    }
    public function department()
    {
        return $this::belongsTo('\App\Department','department_id');
    }
    public function branch()
    {
        return $this::belongsTo('\App\Branch','branch_id');
    }
}
