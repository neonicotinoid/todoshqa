@props(['label', 'fieldset' => false, 'tip' => null])

@if($fieldset)
    <fieldset {{$attributes}}>
        <legend class="block font-medium text-gray-900">
            {{ $label }}
        </legend>
        @if($tip)
            <div class="text-sm leading-5 font-normal text-gray-400">
                {{ $tip }}
            </div>
        @endif
            {{ $slot }}
    </fieldset>
@else
    <div x-data x-id="['input']" {{$attributes}}>
        <label x-bind:for="$id('input')" class="block font-medium text-gray-900">
            {{ $label }}
        </label>
        @if($tip)
            <div class="text-sm leading-5 font-normal text-gray-400">
                {{ $tip }}
            </div>
        @endif
        {{ $slot }}
    </div>
@endif
