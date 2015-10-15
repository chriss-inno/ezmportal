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
}
