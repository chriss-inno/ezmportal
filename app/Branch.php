<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    public function department()
    {
        return $this::hasMany('\App\Department','branch_id','id');
    }
}
