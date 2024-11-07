<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\SoftDeletes;

class Mattress extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'size', 'cost', 'category_id', 'quantity'];

    protected $with = ['latestInventoryCount'];

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

}