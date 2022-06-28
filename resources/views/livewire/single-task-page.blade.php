<div>
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <form class="mt-6" wire:submit.prevent="saveTask">
            <div class="bg-white shadow rounded-lg p-4">
                <a  class="inline-flex bg-purple-50 rounded-full pl-2 pr-3 py-0.5 mb-6 items-center text-sm text-purple-600 hover:bg-purple-100 duration-150"
                    href="{{route('project.show', ['project' => $task->project->id])}}">
                    <x-heroicon-s-chevron-left class="h-5 w-5"/>
                    <span>
                        {{$task->project->title}}
                    </span>
                </a>
                <div>
                    <input type="text"
                           class="block p-2 w-full rounded-lg text-xl sm:text-2xl md:text-3xl text-gray-700 font-semibold bg-gray-50 hover:bg-gray-100 outline-none border-none"
                           wire:model.debounce.800ms="task.title">
                    @error('task.title')
                    <div class="text-red-500 mt-0.5">
                        {{$message}}
                    </div>
                    @enderror
                </div>

                <div class="mt-6">
                    <label for="description" class="block font-medium text-gray-500 mb-1">Описание задачи:</label>
                    <textarea
                        id="description"
                        class="block w-full max-w-screen-sm bg-transparent rounded-lg border border-gray-200"
                        wire:model.debounce.800ms="task.description">{{$task->description}}</textarea>
                </div>

                <div class="mt-6">
                    <div class="block font-medium text-gray-500 mb-1">
                        Крайний срок для выполнения
                    </div>
                    <div x-data class="bg-gray-100 max-w-xs p-2 flex items-center rounded-lg justify-between">
                        <input class="text-sm border border-gray-200 rounded-lg px-2 py-1.5" type="date"
                               wire:model="task.deadline_date"
                        >
                        <button @click="$wire.call('resetDeadline')"
                                class="inline-flex items-center bg-red-50 text-red-600 border border-red-300 rounded-lg py-1 px-2 text-xs"
                                title="Сбросить дэдлайн">
                            <x-heroicon-s-x class="w-3 h-3 mr-1.5"/>
                            <span>Сбросить</span>
                        </button>
                    </div>
                </div>

                <div class="mt-6 text-gray-400 text-sm">
                    Задача создана {{$task->created_at->format('d.m.Y')}}
                </div>

                <div class="mt-6">
                    <x-button size="xl" icon="heroicon-s-save" icon-on="right">Сохранить</x-button>
                </div>
            </div>

        </form>

    </div>
</div>
