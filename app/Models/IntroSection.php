<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntroSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
    ];

    public function child_sections(){
        return $this->hasMany(ChildSection::class);
    }
}
