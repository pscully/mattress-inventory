<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name'];

    public function inventoryCounts()
    {
        return $this->hasMany(InventoryCount::class);
    }

    public function mattresses()
    {
        return $this->belongsToMany(Mattress::class, 'mattress_store')
                    ->withPivot('inventory_count')
                    ->withTimestamps();
    }

    public function name()
    {
        return $this->name;
    }
}
