<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClubReg extends Model
{
    use HasFactory;

    protected $fillable = [
        'clubName',
        'email',
        'phone',
        'subject',
        'contactPerson',
        'message',
    ];
}
