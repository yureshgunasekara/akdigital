<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntroSectionChild extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'intro_sections_id',
    ];

    public function intro_section(){
        return $this->belongsTo(IntroSection::class);
    }

    public function section_links(){
        return $this->hasMany(ChildSectionLink::class);
    }
}
