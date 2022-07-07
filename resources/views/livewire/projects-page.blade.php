<div>
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 px-2">

            <div class="mt-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                    <div class="text-xl md:text-3xl font-semibold mb-2 md:mb-0">
                        Ваши проекты
                    </div>
                    <x-button x-data="" icon="heroicon-s-plus" icon-on="right" size="sm" color="blue" @click="Livewire.emit('openCreateProjectWindow')">Создать проект</x-button>
                </div>

                <div class="flex flex-col space-y-4 mb-10">
                    @foreach($this->projects as $project)
                        <x-project-card :project="$project"/>
                    @endforeach
                </div>

            </div>

            <div class="mt-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                    <div class="text-xl md:text-3xl font-semibold mb-2 md:mb-0">
                        Проекты в корзине
                    </div>
                </div>

                <div class="flex flex-col space-y-4 mb-10">
                    @foreach($this->trashedProjects as $project)
                        <x-project-card :project="$project"/>
                    @endforeach
                </div>

            </div>
        </div>
    </main>

    <livewire:create-project-window/>
    <livewire:project-edit-window/>

    @include('includes.project-trash-confirm')


    <div
        x-data="{isOpen: @entangle('isForceDeleteConfirmationOpen').defer}"
        x-trap="isOpen"
        x-show="isOpen"
        x-cloak
        class="relative z-10"
        aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
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
                        <div class="">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg leading-6 font-medium text-gray-900">
                                    Вы хотите полностью удалить проект?
                                </h3>
                                <x-heroicon-s-exclamation class="w-5 h-5 text-red-500"/>
                            </div>
                        </div>

                        <div class="text-gray-700">
                            <p class="my-1">
                                Проект <span class="text-blue-500 font-medium">{{$this->interactionProject->title ?? ''}}</span> и все задачи в этом проекте будут полностью удалены.
                            </p>
                            <p class="my-1">
                                Их нельзя будет восстановить.
                            </p>

                        </div>
                    </div>
                    <div class="mt-5 sm:mt-6">
                        <x-button wire:click="forceDeleteProject({{$this->interactionProject->id ?? ''}})"
                                  icon="heroicon-s-trash"
                                  icon-on="right"
                                  color="red"
                                  class="w-full">
                            Удалить проект
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
