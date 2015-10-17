<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CopsIssuesRM extends Model
{
    //
    public function issues()
    {
        return $this::hasMany('\App\CopsIssues','rm_id','id');
    }
}
