<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportReplay extends Model
{
    use HasFactory;

    protected $fillable = [
        'support_id',
        'replay_from',
        'description',
        'attachment',
    ];

    public function support(){
        return $this->belongsTo(Support::class);
    }
}
