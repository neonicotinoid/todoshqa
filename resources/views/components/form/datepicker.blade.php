@props(['title' => null])

<div x-data="datepickerDeadline()" wire:ignore
     x-bind="wrapper"
    >

    <div class="flex items-center justify-between">
        <x-form.text class="hidden" x-ref="wireable" {{ $attributes->thatStartWith('wire:') }} hidden/>
        <x-form.text class="w-auto" x-ref="dateForUser"/>
        <x-button type="button" @click="resetDate" size="xs" color="white">Сбросить</x-button>
    </div>
    <div x-ref="datepickerInput"
           x-bind:id="$id('input')"
            x-bind="datepickerElem"
           class="block mt-1.5 w-full px-2.5 py-2 rounded-lg border border-black
                hover:border-purple-300
                placeholder:text-gray-500 placeholder:font-normal
                focus:ring-1 focus:ring-purple-500 focus:border-purple-500 ring-inset
                disabled:bg-gray-200 disabled:text-white disabled:cursor-not-allowed disabled:hover:border-gray-300
                duration-150"></div>
</div>
