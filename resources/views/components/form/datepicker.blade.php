@props(['title' => null])

<div x-data="{datepicker: null}" wire:ignore
     x-init="datepicker = new window.Datepicker($refs.datepickerInput, {
        title: @js('title')
     });"
    @task-sidebar-open.window="
        console.log($event.detail.deadline_date);
        if ($event.detail.deadline_date) {
            datepicker.setDate(new Date($event.detail.deadline_date));
        }
    "
    >

    <x-form.text class="hidden" x-ref="wireable" {{ $attributes->thatStartWith('wire:') }} hidden/>
    <x-form.text x-ref="dateForUser"/>
    <div x-ref="datepickerInput"
           x-bind:id="$id('input')"
           x-on:change-date.camel="$dispatch('input', $event.detail.date)"
           @input.prevent.stop
           @change-date.camel="
           $refs.wireable.value = formatDate($event.detail.date);
           $refs.wireable.dispatchEvent(new Event('input'));
           $refs.dateForUser.value = formatDate($event.detail.date);
            "
           class="block mt-1.5 w-full px-2.5 py-2 rounded-lg border border-black
                hover:border-purple-300
                placeholder:text-gray-500 placeholder:font-normal
                focus:ring-1 focus:ring-purple-500 focus:border-purple-500 ring-inset
                disabled:bg-gray-200 disabled:text-white disabled:cursor-not-allowed disabled:hover:border-gray-300
                duration-150"></div>
</div>
