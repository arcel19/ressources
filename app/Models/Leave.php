<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Leave extends Model
{
    use HasFactory;
    protected $fillable = ['type', 'from', 'to', 'reason', 'remaining_leave', 'soldier_id', 'status', 'number_of_days'];

    public function soldiers(): BelongsTo
    {
        return $this->belongsTo(Soldier::class, 'soldier_id');
    }
    public function scopeFilter($query, $filters)
    {
        $query->where(function ($query) use ($filters) {
            if ($filters['search'] ?? false) {
                $query->orWhereHas('soldiers', function ($query) use ($filters) {
                    $query->where('name', 'like', '%' . $filters['search'] . '%');
                });
            }

            if ($filters['search1'] ?? false) {
                $query->orWhere('type', 'like', '%' . $filters['search1'] . '%');
            }

            if ($filters['search2'] ?? false) {
                $query->orWhere('status', 'like', '%' . $filters['search2'] . '%');
            }


        });
        return $query;


    }
}
