@props(['task'])

<div {{$attributes}} class="flex bg-white shadow rounded-lg px-4 py-3 border border-transparent hover:bg-gray-50 duration-150">

    <input @checked($task->completed_at)
           type="checkbox"
           wire:loading.attr="disabled"
           wire:change.prevent="toggleTaskState({{$task->id}})"
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
        <div class="mt-1 flex items-center text-xs md:text-sm text-yellow-400">
            <x-heroicon-o-calendar class="w-4 h-4 mr-1.5"/>
            tomorrow
        </div>
    </div>

    <div class="relative ml-auto">
        <button wire:click="openTask({{$task->id}})">
            <x-heroicon-o-dots-vertical class="w-6 h-6 text-gray-300"/>
        </button>
    </div>
</div>
