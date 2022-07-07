@props(['project'])
@php
    /** @var \App\Models\Project $project */
@endphp

<div class="bg-white shadow-sm p-3 md:p-4 rounded-lg border border-gray-200 hover:border-blue-300 duration-150">
    <div class="flex items-start">
        <div>
            <div class="text-base text-gray-900">
                <a class="border-b border-blue-200" href="{{ route('project.show', ['project' => $project->id]) }}">
                    {{ $project->title }}
                </a>
            </div>
            @if($project->description)
                <div class="text-xs mt-1 text-gray-500">
                    {{ $project->description }}
                </div>
            @endif
        </div>


        @if(!$project->trashed())
            <div class="ml-auto flex space-x-2">
                <button x-data @click="Livewire.emit('openProjectEditWindow', {{$project->id}});">
                    <x-heroicon-s-pencil class="w-4 h-4 text-gray-300"/>
                </button>
                <button wire:click="askToTrashProject({{$project->id}})">
                    <x-heroicon-s-trash class="w-4 h-4 text-red-300"/>
                </button>
            </div>
        @else
            <div class="ml-auto flex space-x-2">
                <x-button wire:click="restoreProject({{$project->id}})" size="xs" color="white">Восстановить</x-button>
                <x-button wire:click="askToForceDeleteProject({{$project->id}})" size="xs" color="red">Удалить полностью</x-button>
            </div>
        @endif

    </div>
</div>
