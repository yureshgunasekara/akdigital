<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'language',
        'description',
        'code',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
