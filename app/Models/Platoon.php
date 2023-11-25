<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platoon extends Model
{
    use HasFactory;
    protected $fillable = ['name','functionality','unitCompany_id'];
}
