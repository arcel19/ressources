<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soldier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'rank', 'position',
        'date_of_birth',
        'matricular',

        'specialization',
        'bloodGroup',
        'gender',
        'nationality',
        'regionOfBirth',
        'marialStatus',
        'photo'
    ];

    public function leaves()
    {
        return $this->hasMany(Leave::class, 'soldier_id');
    }

    public function scopeFilter($query, $filters)
    {
        $query->where(function ($query) use ($filters) {

            if ($filters['search'] ?? false) {
                $query->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('position', 'like', '%' . $filters['search'] . '%');
            }
            if ($filters['search1'] ?? false) {
                $query->where('matricular', 'like', '%' . $filters['search1'] . '%')
                    ->orWhere('bloodGroup', 'like', '%' . $filters['search1'] . '%');
            }
            if ($filters['search2'] ?? false) {
                $query->orWhere('position', 'like', '%' . $filters['search2'] . '%');
            }
        });
        return $query;
    }
}
