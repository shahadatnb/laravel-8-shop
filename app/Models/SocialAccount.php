<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 'provider_name', 'provider_id'
    ];

    // User
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
