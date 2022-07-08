@props([
    'href' => null,
    'size' => 'base',
    'color' => 'primary',
    'icon' => null,
    'iconOn' => 'left',
    'pressable' => true,
    ])


@php
    $classes = $attributes->class([
                   'flex items-center justify-center whitespace-nowrap space-x-2 text-center
                    active:ring-2 active:ring-offset-1
                    focus:ring-2 focus:ring-offset-1
                    disabled:bg-gray-300 disabled:text-gray-100 disabled:cursor-not-allowed disabled:active:shadow-none
                    duration-200
                    outline-none
                   ',

                   'bg-purple-500 hover:bg-purple-600 text-white active:ring-2 active:ring-purple-500 focus:ring-purple-300' => $color === 'primary',
                   'bg-purple-50 text-purple-800 border border-purple-300 hover:bg-purple-100 focus:ring-purple-300 active:ring-purple-500' => $color === 'secondary',
                   'bg-white text-gray-800 border border-gray-200 shadow-sm hover:bg-gray-50 active:ring-blue-600' => $color === 'white',
                   'bg-blue-500 hover:bg-blue-600 text-blue-50 shadow-sm active:ring-blue-600' => $color === 'blue',
                   'bg-red-50 text-red-600 border border-red-300 focus:ring-red-200 active:ring-red-600' => $color === 'red',
                   'bg-yellow-300 text-yellow-900 hover:bg-yellow-300 focus:ring-yellow-300 active:ring-yellow-400' => $color === 'yellow',


                   'py-1.5 px-2 text-xs rounded-lg' => $size === 'xs',
                   'py-1.5 px-4 text-sm rounded-lg' => $size === 'sm',
                   'py-2 px-5 text-sm rounded-lg' => $size === 'base',
                   'py-2.5 px-6 text-lg font-medium rounded-xl' => $size === 'lg',
                   'py-3 px-8 text-lg font-semibold rounded-xl ' => $size === 'xl',

                   'flex-row-reverse space-x-reverse' => $iconOn === 'right',
                   'transform active:scale-[0.98] active:shadow-none' => $pressable
               ])->toHtml();
@endphp

@if($href)
    <a  href="{{$href}}"
        {{ $attributes->except(['class', 'icon_position']) }}
        {!!  $classes !!}
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
            {!! $classes !!}
    >
        @if($icon)
            <x-dynamic-component class="w-4 h-4" :component="$icon" />
        @endif

        <span>
            {{ $slot }}
        </span>
    </button>
@endif
