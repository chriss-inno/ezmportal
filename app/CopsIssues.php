<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CopsIssues extends Model
{
    //
    public function rm()
    {
        return $this::hasOne('\App\CopsIssuesRM','rm_id');
    }
}
