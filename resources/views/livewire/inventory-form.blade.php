
<div>
    <h2 class="text-gray-800 text-xl font-bold mb-4">Inventory For: {{ $storeName }}</h2>
    
    <div class="mb-4">
        <select wire:model.live="storeId">
            <option value="">Select a store</option>
            @foreach ($stores as $store)
                <option value="{{ $store->id }}">{{ $store->name }}</option>
            @endforeach
        </select>
    </div>

    @if ($storeId) 
        <form wire:submit="create" class="max-w-md mx-auto border-2 p-4 rounded-md">
            {{ $this->form }}
            
            <!-- Tailwind Submit Button -->
            <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Submit
            </button>
        </form>
        
        <x-filament-actions::modals />
    @endif

    
</div>
