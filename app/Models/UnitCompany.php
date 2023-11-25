<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitCompany extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'city', 'location','brigade_id' ];
    public function scopeFilter($query, $filters)
    {
        $query->where(function ($query) use ($filters) {

            if ($filters['search'] ?? false) {
                $query->orWhere('name', 'like', '%' . $filters['search'] . '%');
            }
        });
        return $query;
}
}
