<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueryAssignment extends Model
{
    //

    public function queries()
    {
        return $this::belongsTo('\App\Query','query_id');
    }
    public function user()
    {
        return $this::belongsTo('\App\User','user_id');
    }
}
