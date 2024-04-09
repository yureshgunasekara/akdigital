<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'template_id',
        'document_name',
        'language',
        'document',
        'word_count',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function template(){
        return $this->belongsTo(Template::class);
    }
}
