@php
    if (!isset($tableItems))
        $tableItems = [];

    if (!isset($actions))
        $actions = [];

    if (!isset($createAction))
        $createAction = null;

    if (!isset($title))
        $title = null;
@endphp

@extends('admin.dashboard')

@section('content')
    <div class="p-6">
        
        @if ($title || $createAction)
            <div class="mb-4 flex justify-between items-center">
                <div>
                    <p class="text-4xl font-extrabold text-gray-800">{{ $title }}</p>
                </div>

                @if ($createAction)
                    <div>
                        <a href="{{ $createAction }}">
                            <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Cadastrar</button>
                        </a>
                    </div>
                @endif
            </div>
        @endif

        <div class="relative bg-red-400 overflow-x-auto shadow-md sm:rounded-lg">
            <table id="table_id2" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        @foreach($tableItems as $item)
                            <th scope="col" class="px-6 py-3"> {{ $item['columnName'] }} </th>
                        @endforeach

                        @if(count($actions) > 0)
                            <th scope="col" class="px-6 py-3"> Ações </th>
                        @endif
                    </tr>
                </thead>
                <tbody>

                    @forelse($data as $item)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                            
                            @foreach($tableItems as $tableItem)
                                @if(isset($item[$tableItem['indexName']]))
                                    <td scope="row" class="px-6 py-4 {{ $tableItem['extraStyle'] ?? '' }}">
                                        {{ $item[$tableItem['indexName']] }}
                                    </td>
                                @endif
                            @endforeach
                            
                            @if(count($actions) > 0)
                                <td class="px-6 py-4">
                                    
                                    @foreach($actions as $action)
                                        @if($action['name'] == 'show')
                                            <a href="{{ route($action['route'], $item['id']) }}">
                                                <button
                                                type="button"
                                                class="call-btn inline-block rounded-full border border-primary p-1.5 mr-1 uppercase leading-normal shadow-[0_4px_9px_-4px_#33ab12] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(51,171,18,0.3),0_4px_18px_0_rgba(51,171,18,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(51,171,18,0.3),0_4px_18px_0_rgba(51,171,18,0.2)] active:shadow-[0_8px_9px_-4px_rgba(51,171,18,0.3),0_4px_18px_0_rgba(51,171,18,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(51,171,18,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(51,171,18,0.5),0_4px_18px_0_rgba(51,171,18,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(51,171,18,0.2),0_4px_18px_0_rgba(51,171,18,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(51,171,18,0.2),0_4px_18px_0_rgba(51,171,18,0.1)]">
                                                    <svg class="w-4 h-4" viewBox="0 0 24.00 24.00" fill="#33ab12" xmlns="http://www.w3.org/2000/svg" stroke="#33ab12">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path d="M14 12c-1.095 0-2-.905-2-2 0-.354.103-.683.268-.973C12.178 9.02 12.092 9 12 9a3.02 3.02 0 0 0-3 3c0 1.642 1.358 3 3 3 1.641 0 3-1.358 3-3 0-.092-.02-.178-.027-.268-.29.165-.619.268-.973.268z"></path>
                                                            <path d="M12 5c-7.633 0-9.927 6.617-9.948 6.684L1.946 12l.105.316C2.073 12.383 4.367 19 12 19s9.927-6.617 9.948-6.684l.106-.316-.105-.316C21.927 11.617 19.633 5 12 5zm0 12c-5.351 0-7.424-3.846-7.926-5C4.578 10.842 6.652 7 12 7c5.351 0 7.424 3.846 7.926 5-.504 1.158-2.578 5-7.926 5z"></path>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </a>
                                        @endif
                                        @if($action['name'] == 'edit')
                                            <a href="{{ route($action['route'], $item['id']) }}">
                                                <button
                                                type="button"
                                                class="call-btn inline-block rounded-full border border-primary p-1.5 mr-1 uppercase leading-normal shadow-[0_4px_9px_-4px_#3b71ca] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(59,113,202,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.5),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.2),0_4px_18px_0_rgba(59,113,202,0.1)]">
                                                    <svg class="w-4 h-4" viewBox="0 0 24.00 24.00" fill="#3B71CA" xmlns="http://www.w3.org/2000/svg" stroke="#3B71CA">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <path fill-rule="evenodd" clip-rule="evenodd" d="m3.99 16.854-1.314 3.504a.75.75 0 0 0 .966.965l3.503-1.314a3 3 0 0 0 1.068-.687L18.36 9.175s-.354-1.061-1.414-2.122c-1.06-1.06-2.122-1.414-2.122-1.414L4.677 15.786a3 3 0 0 0-.687 1.068zm12.249-12.63 1.383-1.383c.248-.248.579-.406.925-.348.487.08 1.232.322 1.934 1.025.703.703.945 1.447 1.025 1.934.058.346-.1.677-.348.925L19.774 7.76s-.353-1.06-1.414-2.12c-1.06-1.062-2.121-1.415-2.121-1.415z" fill="#3B71CA"></path>
                                                        </g>
                                                    </svg>
                                                </button>
                                            </a>
                                        @endif
                                        @if($action['name'] == 'destroy')
                                            <button
                                            type="button"
                                            class="call-btn inline-block rounded-full border border-primary p-1.5 mr-1 uppercase leading-normal shadow-[0_4px_9px_-4px_#b80f0f] transition duration-150 ease-in-out hover:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] focus:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] active:shadow-[0_8px_9px_-4px_rgba(59,113,202,0.3),0_4px_18px_0_rgba(59,113,202,0.2)] dark:shadow-[0_4px_9px_-4px_rgba(209,21,21,0.5)] dark:hover:shadow-[0_8px_9px_-4px_rgba(240,51,51,0.5),0_4px_18px_0_rgba(59,113,202,0.1)] dark:focus:shadow-[0_8px_9px_-4px_rgba(240,51,51,0.2),0_4px_18px_0_rgba(240,51,51,0.1)] dark:active:shadow-[0_8px_9px_-4px_rgba(240,51,51,0.2),0_4px_18px_0_rgba(240,51,51,0.1)]">
                                                <svg class="w-4 h-4" viewBox="0 0 24.00 24.00" fill="#b80f0f" xmlns="http://www.w3.org/2000/svg" stroke="#b80f0f">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier"> 
                                                        <path d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6M14 10V17M10 10V17" stroke="#b80f0f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> 
                                                    </g>
                                                </svg>
                                            </button>
                                        @endif
                                    @endforeach

                                </td>
                            @endif
                        </tr>
                    @empty
                        
                    @endforelse
                </tbody>
            </table>

            {{ $data->links() }}
            
        </div>
    </div>
@endsection