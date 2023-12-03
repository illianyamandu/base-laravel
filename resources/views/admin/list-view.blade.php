@php
    if (!isset($tableItems))
        $tableItems = [];
@endphp

@extends('admin.dashboard')

@section('content')
    <div class="p-6">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
            <table id="table_id2" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        @foreach($tableItems as $item)
                            <th scope="col" class="px-6 py-3"> {{ $item['columnName'] }} </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>

                    @forelse($data as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                            @foreach($tableItems as $tableItem)
                                @if(isset($item[$tableItem['indexName']]))
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $item[$tableItem['indexName']] }}
                                    </th>
                                @endif
                            @endforeach
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>

            {{ $data->links() }}
            
        </div>
    </div>
@endsection