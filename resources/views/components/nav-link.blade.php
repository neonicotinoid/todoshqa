@props(['isActive' => false, 'href'])

@if($isActive)
    <span class="bg-gray-900 text-white px-3 py-2 rounded-md text-sm font-medium">
        {{ $slot }}
    </span>
@else
    <a class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium" href="{{$href}}">
        {{ $slot }}
    </a>
@endif
