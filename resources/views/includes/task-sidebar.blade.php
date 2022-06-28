<div x-data="{ rendered: @entangle('isTaskModalOpen') }"
     x-cloak
     x-show="rendered"
     @keydown.esc="rendered = false"
     @keydown.cmd.enter="$wire.saveOpenedTask().then(() => {rendered = false;}); "
     x-trap.noscroll="rendered"
     class="relative z-10"
     aria-labelledby="slide-over-title"
     role="dialog"
     aria-modal="true"
     tabindex="0"
>
    <!-- Background backdrop, show/hide based on slide-over state. -->
    <div class="fixed inset-0 bg-gray-700/30"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">

                <div x-show="rendered"
                     x-transition:enter="transform transition ease-in-out duration-150 sm:duration-150"
                     x-transition:enter-start="translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transform transition ease-in-out duration-150 sm:duration-150"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="translate-x-full"
                     class="pointer-events-auto w-screen max-w-md"
                     @click.outside="rendered = false"
                     id="task-sidebar"
                >
                    <form class="flex h-full flex-col divide-y divide-gray-200 bg-white shadow-xl">
                        <div class="h-0 flex-1 overflow-y-auto">
                            <div class="bg-gray-900 py-4 px-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-lg font-medium text-white">
                                        Информация о задаче
                                    </h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button
                                            @click="rendered = false"
                                            type="button" class="rounded-md bg-gray-800 text-indigo-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                                            <span class="sr-only">Close panel</span>
                                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="flex flex-1 flex-col justify-between">
                                <div class="divide-y divide-gray-200 px-4 sm:px-6">
                                    <div class="space-y-6 pt-6 pb-5">
                                        <x-form.group label="Название задачи">
                                            <x-form.textarea rows="2" class="text-sm" wire:model.debounce.defer="openedTask.title"/>
                                        </x-form.group>
                                        <x-form.group label="Описание задачи">
                                            <x-form.textarea placeholder="Введите описание задачи..." class="text-sm" rows="4" wire:model.defer="openedTask.description"/>
                                        </x-form.group>


                                        <x-form.group label="Срок выполнения">
                                            <x-form.datepicker title="Дэдлайн" wire:model.defer="openedTask.deadline_date"/>
                                        </x-form.group>
                                    </div>
                                    <div class="pt-4 pb-6">
                                        <div class="flex text-sm">
                                            <a href="#" class="group inline-flex items-center font-medium text-purple-500 hover:text-purple-900">
                                                <!-- Heroicon name: solid/link -->
                                                <x-heroicon-s-link class="w-5 h-5 text-purple-500 group-hover:text-purple-900"/>
                                                <span class="ml-2"> Copy link </span>
                                            </a>
                                        </div>
                                        <div class="mt-4 flex text-sm">
                                            <a href="#" class="group inline-flex items-center text-gray-500 hover:text-gray-900">
                                                <!-- Heroicon name: solid/question-mark-circle -->
                                                <x-heroicon-s-question-mark-circle class="w-5 h-5 text-gray-400 group-hover:text-gray-500"/>
                                                <span class="ml-2"> Learn more about sharing </span>
                                            </a>
                                        </div>
                                        <div>
                                            {{$openedTask->completed_at ?? ''}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="py-2">
                            <div class="flex justify-center text-gray-500 items-center">
                                <x-key>CMD</x-key>
                                +
                                <x-key>Enter</x-key>
                                <div class="text-xs text-gray-500 ml-2">
                                    to save and close
                                </div>
                            </div>
                        </div>

                        <div class="py-2">
                            <div class="flex justify-center text-gray-500 items-center">
                                <x-key>Esc</x-key>
                                <div class="text-xs text-gray-500 ml-2">
                                    to close
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-shrink-0 justify-end space-x-4 px-4 py-4">
                            <x-button class="w-full" wire:click.prevent="saveOpenedTask" icon="heroicon-s-save">Сохранить изменения</x-button>
                            <x-button class="w-full" color="secondary" icon="heroicon-s-check">Выполнено!</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
