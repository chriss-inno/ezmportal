<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Right extends Model
{
    //
    public function userRights()
    {
        return $this::hasMany('\App\UserRight','right_id','id');
    }
}
