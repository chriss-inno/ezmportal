<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssuesDailyUpdates extends Model
{
    //
    public function issue()
    {
        return $this::belongsTo('\App\IssuesDailyUpdates','issue_id');
    }
}
