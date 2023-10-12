@php
    $submenu = isset($attributes['submenu']) && $attributes['submenu'] == true;
@endphp

<li class="mb-1 group">
    <a href="#" class="flex items-center py-2 px-4 text-gray-300 hover:bg-gray-950 hover:text-gray-100 rounded-md 
        group-[.active]:bg-gray-800 group-[.active]:text-white group-[.selected]:bg-gray-950 group-[.selected]:text-gray-100 
        {{ $submenu ? 'sidebar-dropdown-toggle' : '' }}"
    >
        
        <i class="{{ $icon ?? '' }}"></i>
        <span class="text-sm">{{ $name ?? '' }}</span>

        @if ($submenu)
            <i class="ri-arrow-right-s-line ml-auto group-[.selected]:rotate-90"></i>
        @endif

    </a>

    {{ $slot }}

</li> 