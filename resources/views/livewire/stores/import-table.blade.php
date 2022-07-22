<div class="relative border border-gray-300 rounded-md overflow-hidden">
    <table class="w-full text-left divide-y table-auto">
        <thead>
            <tr class="bg-gray-50 dark:bg-ray-500/10">
                <th class="p-0">
                    <button type="button" class="flex items-center w-full px-4 py-2 whitespace-nowrap space-x-1 font-medium text-sm text-gray-600 dark:text-gray-300 cursor-default">
                        <span>Name</span>
                    </button>
                </th>
                <th class="p-0">
                    <button type="button" class="flex items-center w-full px-4 py-2 whitespace-nowrap space-x-1 font-medium text-sm text-gray-600 dark:text-gray-300 cursor-default">
                        <span>Location</span>
                    </button>
                </th>
                <th class="p-0">
                    <button type="button" class="flex items-center w-full px-4 py-2 whitespace-nowrap space-x-1 font-medium text-sm text-gray-600 dark:text-gray-300 cursor-default">
                        <span>Location Code</span>
                    </button>
                </th>
                <th class="p-0">
                    <button type="button" class="flex items-center w-full px-4 py-2 whitespace-nowrap space-x-1 font-medium text-sm text-gray-600 dark:text-gray-300 cursor-default">
                        <span>Store Group</span>
                    </button>
                </th>
            </tr>
        </thead>
        <tbody>
            @if($stores->count() > 0)
            @foreach($stores as $item)
            <tr>
                <td>
                    <div class="px-4 py-3">
                        {{ $item->storename }}
                    </div>
                </td>
                <td>
                    <div class="px-4 py-3">
                        {{ $item->storelocation }}
                    </div>
                </td>
                <td>
                    <div class="px-4 py-3">
                        {{ $item->location_code }}
                    </div>
                </td>
                <td>
                    <div class="px-4 py-3">
                        {{ $item->store_group }}
                    </div>
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="4">
                    <div class="px-4 py-3 text-center">
                        No data yet.
                    </div>
                </td>
            </tr>
            @endif
        </tbody>
    </table>
    <div class="py-2 px-4 border-t border-gray-300 bg-gray-50">
        {{ $stores->links() }}
    </div>
</div>
