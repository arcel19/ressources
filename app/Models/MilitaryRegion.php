<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MilitaryRegion extends Model
{
    use HasFactory;
    protected $fillable =['name', 'city','location','nationalArmy_id'];
}
