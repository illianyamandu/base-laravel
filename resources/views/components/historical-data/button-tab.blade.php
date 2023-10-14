<button type="button" data-tab="{{ $tab ?? '' }}" data-tab-page="{{ $tabPage ?? '' }}" 
{{ $attributes->merge(["class" => "text-gray-400 font-medium text-[13px] hover:text-gray-600 border-b-2 border-b-transparent mr-4 p-1"])}}>
{{ $name ?? '' }}
</button>