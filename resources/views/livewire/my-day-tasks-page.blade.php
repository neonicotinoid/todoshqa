<div>
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="space-y-4 px-2 md:px-0">
                <div class="flex justify-between mb-4">
                    <h2 class="text-xl font-semibold text-gray-500">
                        Задачи
                    </h2>
                </div>
        </div>

            <div class="space-y-4">
                @forelse($this->dayTasks as $task)
                    <livewire:task-card :task="$task" :wire:key="$task->id" />
                @empty
                    <div class="text-gray-500 font-medium p-4 text-center border rounded-lg">
                        Вы не добавили задач на сегодня
                    </div>
                @endforelse
            </div>

            <div class="mt-10 px-2 md:px-0" x-data="{isOpen: @entangle('isCompletedTasksOpen').defer}">
                <div class="flex items-center">
                    <h2 class="text-xl font-semibold text-gray-500">
                        Завершенные задачи
                    </h2>

                    <x-button size="xs" color="white" class="ml-2" @click="isOpen = !isOpen" x-text="isOpen ? 'Скрыть' : 'Показать'">Скрыть</x-button>
                </div>

                <div class="mt-4 space-y-4"
                     x-cloak
                     x-show="isOpen"
                     @keydown.ctrl.shift.d.window="isOpen = !isOpen">
                    @forelse($this->dayCompletedTasks as $task)
                        <livewire:task-card :task="$task" :wire:key="$task->id" />
                    @empty
                        <div class="font-medium text-gray-400 text-sm">
                            Пока в проекте нет выполненных задач
                        </div>
                    @endforelse
                </div>
            </div>


</div>
