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

class InventoryForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public $test = "test";

    public function mount(): void
    {
        $this->form->fill();
    }
    
    public function getAllMattresses()
    {
        $mattresses = [];
        foreach (Mattress::all() as $mattress) {
            $mattresses[] = TextInput::make($mattress->name)->numeric();
        }
        return $mattresses;
    }

    public function form(FilamentForm $form): FilamentForm
    {
        return $form
            ->schema([
               ...$this->getAllMattresses()
            ])->statePath('data');
    }

    public function create()
    {
        foreach ($this->form->getState() as $mattress => $count) {
            InventoryCount::create([
                'mattress_id' => Mattress::where('name', $mattress)->first()->id,
                'count' => $count,
            ]);
        }

        return $this->redirect(route('app'));
    }

    public function render(): View
    {
        return view('livewire.inventory-form');
    }
}
