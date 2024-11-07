<div>
    <form wire:submit="create" class="max-w-md mx-auto border p-4 rounded-md">
        {{ $this->form }}
        
        <!-- Tailwind Submit Button -->
        <button type="submit" class="mt-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Submit
        </button>
    </form>
    
    <x-filament-actions::modals />
</div>
