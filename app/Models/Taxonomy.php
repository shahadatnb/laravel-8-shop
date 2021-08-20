<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Taxonomy extends Model
{
    public $timestamps = false;
    public function posts(){
        return $this->belongsToMany(Post::class, 'post_tax','tax_id','post_id');
    }
    
    public function postsDoById(){
        return $this->belongsToMany(Post::class, 'post_tax','tax_id','post_id')->orderBy('id','desc');
    }

    public function postsBySort(){
        return $this->belongsToMany(Post::class, 'post_tax','tax_id','post_id')->orderBy('sort');
    }
}
