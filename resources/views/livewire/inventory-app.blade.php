<div class="overflow-x-auto">
    <div>
        <select wire:model.live="storeId">
            <option value="all">All Stores</option>
            @foreach ($stores as $store)
                <option value="{{ $store->id }}">{{ $store->name }}</option>
            @endforeach
        </select>
</div>

    <!-- show inventory table for selected store -->

    <div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="py-2 px-4 text-left text-sm font-semibold text-gray-700">Mattress Name</th>
                <th class="py-2 px-4 text-left text-sm font-semibold text-gray-700">Current Count</th>
                <th class="py-2 px-4 text-left text-sm font-semibold text-gray-700">Last Updated</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mattresses as $mattress)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-2 px-4 text-gray-800">{{ $mattress->name }}</td>
                    <td class="py-2 px-4 text-gray-800">
                        {{ $mattress->storeInventoryCounts->first()?->count ?? 0 }}
                    </td>
                    <td class="py-2 px-4 text-gray-800">
                        {{ $mattress->storeInventoryCounts->first()?->updated_at->format('Y-m-d H:i') ?? 'Not Yet Recorded' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


</div>

