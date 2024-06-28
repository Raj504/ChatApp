<?php

namespace App\Models;

use App\Models\ChatGroup;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'content',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function chatGroup() {
        return $this->belongsTo(ChatGroup::class);
    }
}
