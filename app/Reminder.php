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
}
