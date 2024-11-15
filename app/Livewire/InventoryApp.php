<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mattress;
use App\Models\Store;
use App\Models\InventoryCount;

class InventoryApp extends Component
{

    public $mattresses = [];

    public $storeId = 'all';

    public $stores;

     public $selectedDate = 'latest';
     public $inventoryDates;


    public function mount()
    {
        $this->stores = Store::all();
        $this->mattresses = Mattress::all();

        $this->updateInventoryDates();

    }

private function updateInventoryDates()
    {
        if ($this->storeId === 'all') {
            $this->inventoryDates = collect(['latest' => 'Latest']);
        } else {
            $dates = InventoryCount::where('store_id', $this->storeId)
                ->distinct()
                ->pluck('created_at')
                ->sortDesc()
                ->map(function ($date) {
                    return $date->format('Y-m-d');
                });

            $this->inventoryDates = $dates->prepend('Latest', 'latest')->unique();
        }
    }

private function updateMattresses()
    {
        if ($this->storeId === 'all') {
            $this->mattresses = Mattress::all();
        } else {
            $query = Mattress::whereHas('stores', function($query) {
                $query->where('store_id', $this->storeId);
            });

            if ($this->selectedDate !== 'latest') {
                $date = \Carbon\Carbon::parse($this->selectedDate);
                $query->with(['storeInventoryCounts' => function($query) use ($date) {
                    $query->where('store_id', $this->storeId)
                        ->whereDate('created_at', $date);
                }]);
            } else {
                $query->with(['storeInventoryCounts' => function($query) {
                    $query->where('store_id', $this->storeId)
                        ->latest();
                }]);
            }

            $this->mattresses = $query->get();
        }
    }

public function updatedSelectedDate()
    {
        $this->updateMattresses();
    }



    public function updatedStoreId()
        {
            $this->updateInventoryDates();
            $this->selectedDate = 'latest';
            $this->updateMattresses();
        }

    public function render()
    {
        return view('livewire.inventory-app');
    }
}
