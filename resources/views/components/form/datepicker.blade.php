@props(['title' => null])

<div x-data="datepickerDeadline()" wire:ignore
     x-bind="wrapper"
    >

    <div class="flex items-center justify-between">
        <x-form.text class="hidden" x-ref="wireable" {{ $attributes->thatStartWith('wire:') }} hidden/>
        <x-form.text class="w-auto" placeholder="Срок не установлен" @focusin="isOpen = true" @focusout="isOpen = false" x-ref="dateForUser" />

        <button @click="resetDate" class="inline-flex items-center bg-red-50 text-red-600 rounded-full py-1 px-2 text-xs" title="Сбросить дэдлайн">
            <x-heroicon-s-x class="w-3 h-3 mr-1.5"/>
            <span>Сбросить</span>
        </button>
    </div>
    <div
        x-ref="datepickerInput"
        x-show="isOpen"
         x-bind:id="$id('input')"
         x-bind="datepickerElem"
         class="absolute mt-1.5 w-auto bg-white px-2.5 py-2 rounded-lg border border-gray-300 shadow-lg
                hover:border-purple-300
                placeholder:text-gray-500 placeholder:font-normal
                focus:ring-1 focus:ring-purple-500 focus:border-purple-500 ring-inset
                disabled:bg-gray-200 disabled:text-white disabled:cursor-not-allowed disabled:hover:border-gray-300
                duration-150"></div>
</div>
