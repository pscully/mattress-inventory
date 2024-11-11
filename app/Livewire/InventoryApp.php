<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mattress;
use App\Models\Store;
class InventoryApp extends Component
{

    public $mattresses = [];

    public $storeId;

    public $stores;


    public function mount()
    {
        $this->stores = Store::all();
        $this->mattresses = Mattress::all();


    }



    public function updatedStoreId()
    {

        if ($this->storeId === 'all') 
        {
            $this->mattresses = Mattress::all();
        } else {
            $this->mattresses = Mattress::whereHas('stores', function($query) {
                $query->where('store_id', $this->storeId);
            })
            ->with(['storeInventoryCounts' => function($query) {
                $query->where('store_id', $this->storeId);
            }])
            ->get();
        }
        
        
    }

    public function render()
    {
        return view('livewire.inventory-app');
    }
}
