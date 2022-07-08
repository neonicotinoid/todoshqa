<div>
    <header class="bg-white shadow">

    </header>
    <main>

        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div>
                <h1 class="text-xl md:text-3xl font-semibold md:font-bold text-gray-900">
                    {{$project->title}}
                </h1>
                @if($project->description)
                    <div class="text-xs md:text-sm text-gray-400 mt-2">
                        {{$project->description}}
                    </div>
                @endif
            </div>
            <div class="hidden sm:block">
                <button x-data class="w-6 h-6 inline-flex justify-center items-center shadow-sm bg-white border border-gray-200 rounded p-1"
                        @click="Livewire.emit('openProjectEditWindow', {{$project->id}});">
                    <x-heroicon-s-cog class="text-gray-400"/>
                </button>
                <button x-data class="w-6 h-6 inline-flex justify-center items-center shadow-sm bg-white border border-gray-200 rounded p-1"
                        @click="Livewire.emit('openProjectSharingWindow');"
                >
                    <x-heroicon-s-share class="text-gray-400"/>
                </button>
                <button x-data class="w-6 h-6 inline-flex justify-center items-center shadow-sm bg-white border border-gray-200 rounded p-1"
                        @click="$dispatch('open-keyboard-help')"
                >
                    <x-heroicon-s-question-mark-circle class="text-gray-400"/>
                </button>
            </div>
            <div class="self-start sm:hidden">
                <button class="mt-1" x-data @click="$dispatch('open-mobile-settings-modal')">
                    <x-heroicon-o-dots-vertical class="w-5 h-5 text-gray-500"/>
                </button>
            </div>
        </div>

        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <div class="space-y-4 px-2 md:px-0">
                <div class="flex justify-between">
                    <div>
                        <x-heroicons-loading wire:loading class="w-5 h-5 text-blue-500 animate-spin"/>
                    </div>

                    <div>
                        <select
                            wire:model="sortBy"
                            class="text-sm px-2 py-1 pr-8 rounded-md border-gray-200 bg-gray-50 text-gray-700">
                            <option value="created_desc">newest first</option>
                            <option value="deadline_asc">newest last</option>
                            <option value="deadline">by deadline</option>
                        </select>
                    </div>
                </div>

                <form class="relative" wire:submit.prevent="addNewTask">
                    <div class="flex items-center pb-2 border-b border-gray-200">
                        <x-form.text wire:model.defer="task.title" placeholder="add new task..."/>
                    </div>
                    <div class="absolute right-2 top-3">
                        <button class="bg-white rounded-lg shadow-sm border border-slate-200 text-xs text-slate-500 px-2.5 py-1.5 flex items-center">
                            <x-heroicon-s-plus class="w-3.5 h-3.5 mr-1.5"/>
                            <span>
                                Add
                            </span>
                        </button>
{{--                        <x-button icon="heroicon-s-plus-sm" icon-on="right" color="white" size="xs">Добавить</x-button>--}}
                    </div>
                </form>

                @forelse($this->actualTasks as $task)
                    <livewire:task-card :task="$task" :wire:key="$task->id"/>
                @empty
                    <div class="text-gray-500 font-medium p-4 text-center border rounded-lg">
                        you don't have any actual tasks in this project
                    </div>
                @endforelse
            </div>


            <div class="mt-10 px-2 md:px-0" x-data="{isOpen: true}">
                <div class="flex items-center">
                    <h2 class="text-lg font-medium text-gray-800">
                        Completed tasks
                    </h2>

                    <x-button size="xs" color="white" class="ml-2" @click="isOpen = !isOpen" x-text="isOpen ? 'Hide' : 'Show'">Hide</x-button>
                </div>

                <div class="mt-4 space-y-4" x-show="isOpen" @keydown.ctrl.shift.d.window="isOpen = !isOpen">
                    @forelse($this->completedTasks as $task)
                        <livewire:task-card :task="$task" :wire:key="$task->id" />
                    @empty
                        <div class="font-medium text-gray-400 text-sm">
                            You don't have completed tasks in this project
                        </div>
                    @endforelse
                </div>
            </div>

        </div>

        <livewire:project-edit-window/>
        <livewire:project-sharing-window :project="$project"/>
        <livewire:single-task-window />
        @include('includes.hotkey-help-window')


        <div x-data="{isOpen: false}"
             @open-mobile-settings-modal.window="isOpen = true"
             x-show="isOpen"
             @keydown.esc.window="isOpen = false"
             x-cloak
             x-trap="isOpen"
             class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="fixed z-10 inset-0 overflow-y-auto"
            >
                <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                    <div
                        x-show="isOpen"
                        @click.outside="isOpen = false"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 scale-90"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-90"
                        class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg w-full sm:p-6">
                        <div>

                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Настройки доступа
                                </h3>
                            </div>

                            <div class="flex flex-col space-y-4">
                                <x-button x-data="" color="white" icon="heroicon-s-cog" icon-on="right" @click="isOpen = false; Livewire.emit('openProjectEditWindow', {{$project->id}});">Редактировать</x-button>
                                <x-button x-data="" color="white" icon="heroicon-s-share" icon-on="right" @click="isOpen = false; Livewire.emit('openProjectSharingWindow');">Настройки доступа</x-button>
                            </div>

                            <div class="mt-6">
                                <x-button @click="isOpen = false" class="w-full">Ок, закрыть</x-button>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>




    </main>
</div>
