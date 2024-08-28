<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at','updated_at'];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function sendedBy()
    {
        return $this->belongsTo(User::class,'sended_by_id');
    }
}
