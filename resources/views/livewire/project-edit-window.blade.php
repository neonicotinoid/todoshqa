<div x-data="{isOpen: @entangle('isWindowOpen').defer}"
     x-show="isOpen"
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
            <div class="">
                <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">
                    Данные и настройки проекта
                </h3>

                <form id="project" wire:submit.prevent="saveProject" class="space-y-4">
                    <x-form.group label="Название проекта" wire:ignore>
                        <x-form.text wire:model.defer="project.title"/>
                    </x-form.group>

                    <x-form.group label="Описание проекта" wire:ignore>
                        <x-form.textarea wire:model.defer="project.description"/>
                    </x-form.group>

                </form>

            </div>
        </div>
        <div class="mt-5 sm:mt-6">
            <x-button wire:click="saveProject" form="project" icon="heroicon-o-save" icon-on="right" class="w-full">Сохранить изменения</x-button>
        </div>
    </div>
</div>
    </div>
</div>
