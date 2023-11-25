<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Squadron extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','functionality','platoon_id'
    ];
}
