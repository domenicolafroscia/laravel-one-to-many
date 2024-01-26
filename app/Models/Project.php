<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    use SoftDeletes;

    protected $fillable = ['title', 'content', 'slug', 'cover_image'];

    public function setTitleAttribute($_title) {
        $this->attributes['title'] = $_title;
        $this->attributes['slug'] = Str::slug($_title);
    }
    
}
