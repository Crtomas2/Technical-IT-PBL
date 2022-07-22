<div class="relative border border-gray-300 rounded-md overflow-hidden">
    <table class="w-full text-left divide-y table-auto">
        <thead>
            <tr class="bg-gray-50 dark:bg-ray-500/10">
                <th class="p-0">
                    <button type="button" class="flex items-center w-full px-4 py-2 whitespace-nowrap space-x-1 font-medium text-sm text-gray-600 dark:text-gray-300 cursor-default">
                        <span>First name</span>
                    </button>
                </th>
                <th class="p-0">
                    <button type="button" class="flex items-center w-full px-4 py-2 whitespace-nowrap space-x-1 font-medium text-sm text-gray-600 dark:text-gray-300 cursor-default">
                        <span>Last name</span>
                    </button>
                </th>
                <th class="p-0">
                    <button type="button" class="flex items-center w-full px-4 py-2 whitespace-nowrap space-x-1 font-medium text-sm text-gray-600 dark:text-gray-300 cursor-default">
                        <span>Mobile No.</span>
                    </button>
                </th>
            </tr>
        </thead>
        <tbody>
            @if($promodisers->count() > 0)
            @foreach($promodisers as $item)
            <tr>
                <td>
                    <div class="px-4 py-3">
                        {{ $item->firstname }}
                    </div>
                </td>
                <td>
                    <div class="px-4 py-3">
                        {{ $item->lastname }}
                    </div>
                </td>
                <td>
                    <div class="px-4 py-3">
                        {{ $item->mobile_number }}
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
        {{ $promodisers->links() }}
    </div>
</div>
