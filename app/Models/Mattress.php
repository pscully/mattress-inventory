<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Mattress extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'size', 'cost', 'category_id', 'quantity'];

    protected $with = ['latestInventoryCount', 'stores'];

    protected $casts = [
        'cost' => 'decimal:2',
    ];

    public function category()
        {
            return $this->belongsTo(Category::class);
        }

    public function latestInventoryCount()
        {
            return $this->hasOne(InventoryCount::class)->latest('created_at');
        }

        public function stores()
        {
            return $this->belongsToMany(Store::class, 'mattress_store')
                        ->withPivot('inventory_count')
                        ->withTimestamps();
        }

        public function storeInventoryCounts()
        {
            return $this->hasMany(InventoryCount::class);
        }

}