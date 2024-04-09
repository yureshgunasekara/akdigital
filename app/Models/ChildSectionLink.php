<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildSectionLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'link_text',
        'link_url',
        'child_section_id',
    ];

    public function intro_section_children(){
        return $this->belongsTo(IntroSectionChild::class);
    }
}
