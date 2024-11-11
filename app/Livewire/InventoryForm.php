<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Filament\Forms\Form as FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;
use App\Models\Mattress;
use App\Models\InventoryCount;
use App\Models\Store;
class InventoryForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $storeId;

    public $stores;

    public $mattresses;

    public $storeName;

    public function mount(): void
    {
        $this->stores = Store::all();
        $this->form->fill();

        $this->storeName = "All Stores";
    }

    public function updatedStoreId()
    {
        if ($this->storeId) {
            $store = Store::find($this->storeId);
            $this->storeName = $store ? $store->name : 'Store Not Found';
        } else {
            $this->storeName = 'All Stores';
        }
    }
    
    public function getAllMattressesWithStoreId()
    {

        if ($this->storeId) {
            $this->mattresses = Mattress::whereHas('stores', function($query) {
                $query->where('store_id', $this->storeId);
            })->get();
        } else {
            $this->mattresses = Mattress::all();
        }


        foreach ($this->mattresses as $mattress) {
            $mattresses[] = TextInput::make($mattress->name . '-' . $mattress->size)->label($mattress->name . " " . ucfirst($mattress->size))->numeric()->suffixIcon('heroicon-m-hashtag')->suffixIconColor('success');
        }
        return $mattresses;
    }

    public function form(FilamentForm $form): FilamentForm
    {
        return $form
            ->schema([
               ...$this->getAllMattressesWithStoreId()
            ])->statePath('data');
    }

    public function create()
    {
        foreach ($this->form->getState() as $mattress => $count) {

            $mattressName = explode('-', $mattress)[0];
            $mattressSize = explode('-', $mattress)[1];

            $mattressModel = Mattress::where('name', $mattressName)->where('size', $mattressSize)->first();

            // Check if the mattress exists
            if ($mattressModel) {
                InventoryCount::create([
                    'mattress_id' => $mattressModel->id,
                    'count' => $count,
                    'store_id' => $this->storeId,
                ]);
            } else {
                // Handle the case where the mattress is not found
                // You can log an error, throw an exception, or set a flash message
                session()->flash('error', "Mattress '{$mattress}' not found.");
            }
        }

        return $this->redirect(route('app'));
    }

    public function render(): View
    {
        return view('livewire.inventory-form');
    }
}
