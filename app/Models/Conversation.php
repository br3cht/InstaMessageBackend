<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at','updated_at'];

    public function sender()
    {
        return $this->hasMany(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->hasMany(User::class, 'reciver_id');
    }
}
