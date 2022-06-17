<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
            <h1 class="text-xl md:text-3xl font-bold text-gray-900">
                {{$project->title}}
            </h1>
            @if($project->description)
                <div class="text-xs md:text-sm text-gray-400 mt-2">
                    {{$project->description}}
                </div>
            @endif
        </div>
    </header>
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="space-y-4 px-2 md:px-0">
                @foreach($tasks as $task)
                    <x-task-card :task="$task" wire:key="{{$task->id}}"/>
                @endforeach
            </div>
        </div>



        @include('includes.task-sidebar')


    </main>
</div>
