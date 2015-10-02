<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    public function mSender()
    {
        return $this::belongsTo('\App\User','sender');
    }
    public function mReceiver()
    {
        return $this::belongsTo('\App\User','receiver');
    }
    public function mQuery()
    {
        return $this::belongsTo('\App\Query','query_id');
    }
}
