<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public function menuItem(){
    	return $this->hasMany(MenuItem::class,'menu_id','id')->where('parent_id',null)->orderBy('sl');
    }
}
