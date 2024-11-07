<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
        <thead>
            <tr class="bg-gray-100 border-b">
                <th class="py-3 px-6 text-left text-gray-600 font-semibold uppercase tracking-wider">Mattress Name</th>
                <th class="py-3 px-6 text-left text-gray-600 font-semibold uppercase tracking-wider">Current Count</th>
                <th class="py-3 px-6 text-left text-gray-600 font-semibold uppercase tracking-wider">Last Updated</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($mattresses as $mattress)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-4 px-6 text-gray-700">{{ $mattress->name }}</td>
                    <td class="py-4 px-6 text-gray-700">{{ $mattress->latestInventoryCount->count ?? 'No data' }}</td>
                    <td class="py-4 px-6 text-gray-500">
                        {{ $mattress->latestInventoryCount->created_at ? $mattress->latestInventoryCount->created_at->format('Y-m-d') : 'Not counted yet' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

