@props(['label', 'fieldset' => false, 'tip' => null, 'error' => null])

@if($fieldset)
    <fieldset {{$attributes}}>
        <legend class="block text-sm text-gray-500">
            {{ $label }}
        </legend>
        @if($tip)
            <div class="text-sm leading-5 font-normal text-gray-400">
                {{ $tip }}
            </div>
        @endif
            {{ $slot }}

        @if($error)
            <div class="text-sm text-red-500 mt-1">
                {{ $error }}
            </div>
        @endif
    </fieldset>
@else
    <div x-data x-id="['input']" {{$attributes}}>
        <label x-bind:for="$id('input')" class="block text-sm text-gray-500">
            {{ $label }}
        </label>
        @if($tip)
            <div class="text-sm leading-5 font-normal text-gray-400">
                {{ $tip }}
            </div>
        @endif

        {{ $slot }}

        <div class="h-4">
            @if($error)
                <div class="text-sm leading-5 text-red-500">
                    {{ $error }}
                </div>
            @endif
        </div>

    </div>
@endif
