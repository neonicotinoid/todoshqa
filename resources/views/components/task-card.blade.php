@props(['task'])
    @php /** @var App\Models\Task $task */ @endphp
<div x-data="TaskCard()"
     x-ref="task"
     @keydown.space.prevent="openTask({{$task->id}})"
     @keydown.enter="toggleTaskState({{$task->id}})"
     @keydown.down="focusNextTask()"
     @keydown.up="focusPrevTask()"
     {{$attributes}} class="flex bg-white shadow rounded-lg px-4 py-3 border border-transparent hover:bg-gray-50 duration-150"
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
        @if($task->deadline_date?->isPast() && !$task->deadline_date?->isToday())
            <div class="mt-1 inline-flex items-center justify-center bg-red-100 text-xs md:text-sm text-red-600 px-2 py-0.5 rounded-lg">
                <x-heroicon-o-calendar class="w-3.5 h-3.5 mr-1.5"/>
                {{$task->deadline_date->format('d M')}}
            </div>
        @endif

        @if($task->deadline_date?->isFuture() || $task->deadline_date?->isToday())
            <div class="mt-1 inline-flex items-center justify-center bg-yellow-100 text-xs md:text-sm text-yellow-600 px-2 py-0.5 rounded-lg">
                <x-heroicon-o-calendar class="w-3.5 h-3.5 mr-1.5"/>
                {{$task->deadline_date->format('d M')}}
            </div>
        @endif
    </div>

    <div class="relative ml-auto">
        <button wire:click="openTask({{$task->id}})" tabindex="-1">
            <x-heroicon-o-dots-vertical class="w-6 h-6 text-gray-300"/>
        </button>
    </div>
</div>
