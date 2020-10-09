<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{

    protected $fillable = [
        'reply_text',
    ];

    public function tickets(){
        return $this->belongsTo(Tickets::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
