<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OracleSupport extends Model
{
    //
    public function dailyUpdates()
    {
        return $this::hasMany('\App\IssuesDailyUpdates','issue_id','id');
    }
}
