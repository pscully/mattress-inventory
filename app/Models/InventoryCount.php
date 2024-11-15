<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryCount extends Model
{
    protected $fillable = [
        'mattress_id',
        'count',
        'store_id',
    ];

    protected $casts = [
        'count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function mattress()
    {
        return $this->belongsTo(Mattress::class);
    }

    public function scopeLatestCount($query)
{
    return $query->orderBy('created_at', 'desc')->limit(1);
}

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
