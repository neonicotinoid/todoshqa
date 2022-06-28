@props(['task'])
@php /** @var App\Models\Task $task */ @endphp

<div x-data="TaskCard()"
     x-ref="task"
     @keydown.space.prevent="openTask({{$task->id}})"
     @keydown.enter="toggleTaskState({{$task->id}})"
     @keydown.down="focusNextTask()"
     @keydown.up="focusPrevTask()"
     {{$attributes}}
     class="flex bg-white shadow rounded-lg px-4 py-3 border border-transparent hover:bg-gray-50 duration-150"
     tabindex="0"
     x-task
>

    <input @checked($task->completed_at)
           type="checkbox"
           wire:loading.attr="disabled"
           wire:change.prevent="toggleTaskState({{$task->id}})"
           tabindex="-1"
           @class([
            'relative top-0.5 rounded mr-3 h-5 w-5 border-2 border-fuchsia-300 text-fuchsia-600 duration-150 focus:ring-fuchsia-600',
            'opacity-25' => $task->completed_at,
            ])
           >

    <div>
        <div @class(['text-sm md:text-base text-gray-700', 'line-through opacity-25' => $task->completed_at])
            >
            {{$task->title}}
        </div>

        <div class="flex mt-1">
            @if($task->deadline_date)
                    <div @class([
                         'inline-flex items-center justify-center  text-xs md:text-sm text-gray-400 px-2 py-0.5 rounded-lg',
                         '!bg-gray-100 !text-gray-400' => $task->completed_at,
                         'bg-red-100 text-red-600' => $task->deadline_date?->isPast() && !$task->deadline_date?->isToday(),
                         'bg-yellow-100 text-yellow-600' => $task->deadline_date?->isFuture() || $task->deadline_date?->isToday()
                         ])
                        title="This is deadline date for this task"
                    >
                        <x-heroicon-o-calendar class="w-3.5 h-3.5 mr-1.5"/>
                        {{$task->deadline_date->format('d M')}}
                    </div>
            @endif

                @if($task->description)
                    <div class="inline-flex items-center justify-center bg-gray-100 text-xs md:text-sm text-gray-400 px-2 py-0.5 rounded-lg ml-1.5" title="This task contain additional description">
                        <x-heroicon-s-pencil-alt class="w-3.5 h-3.5"/>
                    </div>
                @endif
        </div>









    </div>

    <div class="relative ml-auto">
        <button
            wire:click="$emit('openTask', {{$task->id}})"
            tabindex="-1">
            <x-heroicon-o-dots-vertical class="w-6 h-6 text-gray-300"/>
        </button>
    </div>
</div>
