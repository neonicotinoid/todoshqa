@props([
    'href' => null,
    'size' => 'base',
    'color' => 'primary',
    'icon' => null,
    'iconOn' => 'left'
    ])

@if($href)
    <a {{ $attributes->except(['class', 'icon_position']) }}
        {{$attributes->class([
                   'flex items-center justify-center whitespace-nowrap space-x-2 rounded-lg text-center
                    disabled:bg-gray-300 disabled:text-gray-100 disabled:cursor-not-allowed disabled:active:shadow-none
                    duration-200
                   ',

                   'bg-purple-500 text-white active:ring-2' => $color === 'primary',
                   'bg-purple-50 text-purple-800 border border-purple-300 hover:bg-purple-100 active:ring-2 ring-purple-500' => $color === 'secondary',
                   'bg-white border border-gray-200 shadow-sm hover:bg-gray-50 active:ring-2 ring-gray-500' => $color === 'white',

                   'py-1.5 px-2 text-xs' => $size === 'xs',
                   'py-1.5 px-4 text-sm' => $size === 'sm',
                   'py-2 px-5 text-sm' => $size === 'base',
                   'py-3 px-5 font-medium' => $size === 'lg',
                   'py-3 px-5 text-lg font-semibold' => $size === 'xl',

                   'flex-row-reverse space-x-reverse' => $iconOn === 'right',
               ])}}
    >
        @if($icon)
            <x-dynamic-component class="w-4 h-4" :component="$icon" />
        @endif
        <span>
            {{ $slot }}
        </span>
    </a>
@else
    <button {{$attributes->except(['class', 'icon_position'])}}
            {{$attributes->class([
                       'flex items-center justify-center whitespace-nowrap space-x-2 rounded-lg text-center
                        disabled:bg-gray-300 disabled:text-gray-100 disabled:cursor-not-allowed disabled:active:shadow-none
                        duration-200
                       ',

                       'bg-purple-500 text-white active:ring-2' => $color === 'primary',
                       'bg-purple-50 text-purple-800 border border-purple-300 hover:bg-purple-100 active:ring-2 ring-purple-500' => $color === 'secondary',
                       'bg-white border border-gray-200 shadow-sm hover:bg-gray-50 active:ring-2 ring-gray-500' => $color === 'white',

                       'py-1.5 px-2 text-xs' => $size === 'xs',
                       'py-1.5 px-4 text-sm' => $size === 'sm',
                       'py-2 px-5 text-sm' => $size === 'base',
                       'py-3 px-5 font-medium' => $size === 'lg',
                       'py-3 px-5 text-lg font-semibold' => $size === 'xl',

                       'flex-row-reverse space-x-reverse' => $iconOn === 'right',
                   ])}}
    >

        @if($icon)
            <x-dynamic-component class="w-4 h-4" :component="$icon" />
        @endif

        <span>
            {{ $slot }}
        </span>
    </button>
@endif
