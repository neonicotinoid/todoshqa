<div x-data="{isOpen: @entangle('isWindowOpen').defer}"
     x-show="isOpen"
     @keydown.meta.enter="$wire.call('createProject'); isOpen = false;"
     @keydown.esc="isOpen = false"
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
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Create project
                            </h3>
                            <x-heroicons-loading wire:loading class="w-4 h-4 animate-spin"/>
                        </div>

                        <form id="project" wire:submit.prevent="createProject" class="space-y-4">

                            <x-form.group label="Project name" :error="$errors->first('projectTitle')" wire:ignore>
                                <x-form.text name="project_name" wire:model="projectTitle"/>
                            </x-form.group>

                            <x-form.group label="Project description" :error="$errors->first('projectDescription')" wire:ignore>
                                <x-form.textarea name="project_description" wire:model="projectDescription"/>
                            </x-form.group>

                        </form>

                    </div>
                </div>
                <div class="mt-5 sm:mt-6">

                    <x-button
                              form="project"
                              icon="heroicon-o-save"
                              icon-on="right"
                              color="blue"
                              class="w-full">
                        Сохранить изменения
                    </x-button>
                    <div class="flex justify-center mt-2 text-gray-500 items-center">
                        <x-key>CMD</x-key> + <x-key>Enter</x-key>
                        <div class="text-xs text-gray-500 ml-2">
                            чтобы создать и закрыть
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
