<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $fillable = [
        'subject', 'ticket_text',
    ];

    public function path(){
        return route('ticket', $this);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies(){
        return $this->hasMany(Reply::class);
    }

    public function isOwnTicket()
    {
       return $this->author->is(current_user());
    }
}
