<div x-data="{isOpen: @entangle('isOpen').defer}"
     x-show="isOpen"
     x-cloak
     @keydown.cmd.enter="$wire.saveTask().then(() => {isOpen = false;})"
     @keydown.esc="isOpen = false;"
     x-trap.inert="isOpen"
     class="relative z-10"
     aria-labelledby="modal-title"
     role="dialog"
     aria-modal="true"
>
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">

            <div
                x-show="isOpen"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-90"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-90"
                class="sm:my-8 sm:max-w-lg w-full sm:p-6">
                <div class="flex justify-end mb-2">

                    <x-button @click="isOpen = false" size="xs" color="white" icon="heroicon-s-x" icon-on="right">Закрыть</x-button>
                </div>
                <div

                    class="relative bg-white rounded-lg px-4 pt-5 pb-4 text-left shadow-xl transform transition-all ">

                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Данные и настройки проекта
                        </h3>
                        <x-heroicons-loading wire:loading wire:target="saveProject" class="w-4 h-4 animate-spin"/>
                    </div>


                    <form class="space-y-4" wire:submit.prevent="saveTask">
                        <x-form.group label="Название задачи">
                            <x-form.textarea rows="2" class="text-sm" wire:model.debounce.defer="task.title"/>
                        </x-form.group>
                        <x-form.group label="Описание задачи">
                            <x-form.textarea placeholder="Введите описание задачи..." class="text-sm" rows="4"
                                             wire:model.defer="task.description"/>
                        </x-form.group>

                        <div class="bg-gray-50 p-2 flex items-center rounded-lg justify-between">
                            <input class="text-sm border border-gray-200 rounded-lg px-2 py-1.5" type="date" wire:model="task.deadline_date"
                            >
                            <button @click="$wire.call('resetDeadline')" class="inline-flex items-center bg-red-50 text-red-600 border border-red-300 rounded-lg py-1 px-2 text-xs" title="Сбросить дэдлайн">
                                <x-heroicon-s-x class="w-3 h-3 mr-1.5"/>
                                <span>Сбросить</span>
                            </button>
                        </div>
                    </form>

                    <div class="mt-6">
                        <x-button class="w-full" wire:click.prevent="saveTask" icon="heroicon-s-save">Сохранить изменения</x-button>
                    </div>

                    <div class="hidden md:block mt-6 text-sm text-gray-500 text-center">
                        <x-key>CMD</x-key> + <x-key>Enter</x-key>
                        <span class="ml-2">to save and close</span>
                    </div>

                </div>
            </div>


        </div>

    </div>
</div>
