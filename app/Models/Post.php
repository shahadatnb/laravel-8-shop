<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;

    public function taxonomy(){
        return $this->belongsToMany(Taxonomy::class, 'post_tax','post_id', 'tax_id');
    }

    public function postMeta()
    {
        return $this->hasMany(Postmeta::class);
    }
}
