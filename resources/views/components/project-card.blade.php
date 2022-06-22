@props(['project'])


<a href="{{route('project.show', ['project' => $project->id])}}"
   class="flex items-start px-2 py-2 bg-white rounded-lg shadow">
    <x-heroicon-s-cube class="flex-shrink-0 relative top-0.5 w-6 h-6 mr-3 text-gray-300"/>
    <div class="text-gray-900">
        <div class="text-lg font-medium">
            {{ $project->title }}
        </div>
        @if($project->description)
            <div class="mt-2 text-sm text-gray-500">
                {{ $project->description }}
            </div>
        @endif

        <div class="flex space-x-2 font-normal mt-4 text-xs text-gray-400">
                                    <span class="bg-gray-100 text-gray-600 py-1 px-2 rounded-lg">
                                        {{ $project->tasks()->actual()->count() }} в работе
                                    </span>
            <span class="bg-green-100 text-green-600 py-1 px-2 rounded-lg">
                                        {{ $project->tasks()->completed()->count() }} завершено
                                    </span>
        </div>

    </div>
</a>
