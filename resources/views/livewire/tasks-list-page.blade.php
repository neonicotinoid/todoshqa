<div>
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div>
                <h1 class="text-xl md:text-3xl font-bold text-gray-900">
                    {{$project->title}}
                </h1>
                @if($project->description)
                    <div class="text-xs md:text-sm text-gray-400 mt-2">
                        {{$project->description}}
                    </div>
                @endif
            </div>
            <div>
                <button x-data class="w-6 h-6 inline-flex justify-center items-center shadow-sm bg-white border border-gray-200 rounded p-1"
                        @click="Livewire.emit('openProjectEditWindow');">
                    <x-heroicon-s-cog class="text-gray-400"/>
                </button>
                <button x-data class="w-6 h-6 inline-flex justify-center items-center shadow-sm bg-white border border-gray-200 rounded p-1"
                        @click="Livewire.emit('openProjectSharingWindow');"
                >
                    <x-heroicon-s-share class="text-gray-400"/>
                </button>
            </div>
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

        <div class="fixed left-0 right-0 bottom-0 p-2 max-w-7xl sm:left-8 sm:right-8 lg:left-12 lg:right-12 mx-auto md:bottom-2 md:rounded-xl md:p-3 md:border md:border-purple-200 md:shadow-xl bg-white border-t border-gray-200">
            <form class="flex flex-nowrap space-x-4" wire:submit.prevent="addNewTask">
                <input type="text" placeholder="Введите новую задачу..."
                       wire:model.defer="newTaskTitle"
                       class="w-full p-1.5 placeholder:text-gray-300 md:text-base md:p-2 rounded-lg border-gray-200 text-sm">
                <x-button size="sm" class="ml-auto" color="secondary">
                    <svg wire:loading class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <x-heroicon-s-plus wire:loading.class="hidden" class="w-5 h-5"/>
                </x-button>
            </form>
        </div>

        <livewire:project-edit-window :project="$project"/>
        <livewire:project-sharing-window :project="$project"/>
        @include('includes.task-sidebar')


    </main>
</div>
