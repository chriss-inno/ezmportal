<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    //
    public function emails()
    {
        return $this::hasMany('\App\ReminderEmail','rmd_id','id');
    }

    public function user()
    {
        return $this::belongsTo('\App\User','user_id');
    }
}
