<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Sales Data List') }}
            </h2>
            <div>
                <a href="{{ route('ess-api.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                    Create
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4 flex items-center justify-end">
                <livewire:export-button :model="\App\Models\SMSAPI::class" filetype="csv" />
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <table class="table-auto px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md w-full">
                    <thead class="px-4 py-3 bg-gray-200 text-right sm:px-6 border-b sm:rounded-bl-md sm:rounded-br-md">
                        <tr height="50">
                            <th align="center">
                                <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                    <span>Barcode No.</span>
                                </div>
                            </th>
                            {{-- <th align="center">
                                <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                    <span>Store Name</span>
                                </div>
                            </th> --}}
                            {{-- <th align="center">
                                <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                    <span>Full Name</span>
                                </div>
                            </th> --}}
                            <th align="center">
                                <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                    <span>Created At</span>
                                </div>
                            </th>
                            <th align="center">
                                <div class="flex items-center justify-center space-x-4 py-2 pl-8 pr-4">
                                    <span>Updated At</span>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @if($smsApi->count() > 0)
                            @foreach($smsApi as $itemCode)
                                <tr>
                                    <td align="center" class="border-b border-slate-200 p-4 pl-8">{{ $itemCode->barcode_number }}</td>
                                    {{-- <td align="center" class="border-b border-slate-200 p-4 pl-8">{{ $itemCode->Store_name }}</td>
                                    <td align="center" class="border-b border-slate-200 p-4 pl-8">{{ $itemCode->Fullname }}</td> --}}
                                    <td align="center" class="border-b border-slate-200 p-4 pl-8">{{ $itemCode->created_at }}</td>
                                    <td align="center" class="border-b border-slate-200 p-4 pl-8">{{ $itemCode->updated_at }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">
                                    <center>No items found.</center>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

