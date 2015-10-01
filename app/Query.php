<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    //
    public function fromDepartment()
    {
        return $this::belongsTo('\App\Department','from_department');
    }

    public function toDepartment()
    {
        return $this::belongsTo('\App\Department','to_department');
    }

    public function user()
    {
        return $this::belongsTo('\App\User','reported_by');
    }

    public function assignment()
    {
        return $this::hasOne('\App\QueryAssignment','query_id');
    }
    public function module()
    {
        return $this::belongsTo('\App\Module','module_id');
    }

    //Query messages
    public function message()
    {
        return $this::hasMany('\App\Message','query_id','id');
    }
}
