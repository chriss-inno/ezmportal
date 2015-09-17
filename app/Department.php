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
}
