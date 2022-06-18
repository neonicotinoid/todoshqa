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
                <h2 class="text-xl font-semibold text-gray-500">
                    Задачи
                </h2>

                @forelse($this->getActualTasksProperty() as $task)
                    <x-task-card :task="$task" wire:key="{{$task->id}}"/>
                @empty
                    <div class="text-gray-500 font-medium p-4 text-center border rounded-lg">
                        У вас нет актуальных задач в этом проекте
                    </div>
                @endforelse
            </div>


            <div class="mt-10 px-2 md:px-0" x-data="{isOpen: true}">
                <div class="flex items-center">
                    <h2 class="text-xl font-semibold text-gray-500">
                        Завершенные задачи
                    </h2>

                    <x-button size="xs" color="white" class="ml-2" @click="isOpen = !isOpen" x-text="isOpen ? 'Скрыть' : 'Показать'">Скрыть</x-button>
                </div>

                <div class="mt-4 space-y-4" x-show="isOpen">
                    @forelse($this->getCompletedTasksProperty() as $task)
                        <x-task-card :task="$task" wire:key="{{$task->id}}" />
                    @empty
                        <div class="font-medium text-gray-400 text-sm">
                            Пока в проекте нет выполненных задач
                        </div>
                    @endforelse
                </div>
            </div>

        </div>



        @include('includes.task-sidebar')


    </main>
</div>
