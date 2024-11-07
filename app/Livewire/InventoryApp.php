<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mattress;

class InventoryApp extends Component
{

    public $mattresses = [];

    public function mount()
    {
       $this->mattresses = Mattress::with('latestInventoryCount')->get();

    }

    public function render()
    {
        return view('livewire.inventory-app');
    }
}
