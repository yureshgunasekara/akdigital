<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Support extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ticket_id',
        'status',
        'category',
        'subject',
        'priority',
    ];

    public function replays(){
        return $this->hasMany(SupportReplay::class);
    }
}
