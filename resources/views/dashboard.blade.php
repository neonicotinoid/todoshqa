<x-layout>
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">

            @php
                $projects = auth()->user()->projects;
                $tasks = \App\Models\Task::query()->take(10)->get();
            @endphp

            <div class="grid grid-cols-3 gap-6 px-2 md:px-0">
                @foreach($projects as $project)
                    <a href="{{route('project.show', ['project' => $project->id])}}" class="flex items-start  p-4 bg-white rounded-lg shadow">
                        <x-heroicon-s-cube class="flex-shrink-0 relative top-0.5 w-6 h-6 mr-3 text-gray-300"/>
                        <div class="text-gray-700">
                            <div class="text-lg font-medium">
                                {{ $project->title }}
                            </div>
                            @if($project->description)
                                <div class="mt-2 text-sm text-gray-700">
                                    {{ $project->description }}
                                </div>
                            @endif

                            <div class="mt-2 bg-gray-50 p-1 text-sm text-gray-400">
                                {{ $project->tasks()->count() }}
                            </div>

                        </div>
                    </a>
                @endforeach
            </div>



        </div>
    </main>
</x-layout>
