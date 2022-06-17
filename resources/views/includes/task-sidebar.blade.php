<div x-data="{ rendered: @entangle('isTaskModalOpen') }"
     x-cloak
     x-show="rendered"
     x-trap="rendered"
     class="relative z-10"
     aria-labelledby="slide-over-title"
     role="dialog"
     aria-modal="true">
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
                     class="pointer-events-auto w-screen max-w-md">
                    <form class="flex h-full flex-col divide-y divide-gray-200 bg-white shadow-xl">
                        <div class="h-0 flex-1 overflow-y-auto">
                            <div class="bg-gray-900 py-4 px-4 sm:px-6">
                                <div class="flex items-center justify-between">
                                    <h2 class="text-lg font-medium text-white" id="slide-over-title">
                                        Информация о задаче
                                    </h2>
                                    <div class="ml-3 flex h-7 items-center">
                                        <button
                                            @click="rendered = false"
                                            type="button" class="rounded-md bg-gray-800 text-indigo-200 hover:text-white focus:outline-none focus:ring-2 focus:ring-white">
                                            <span class="sr-only">Close panel</span>
                                            <!-- Heroicon name: outline/x -->
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
                                            <x-form.textarea rows="2" class="text-sm" wire:model="openedTask.title"/>
                                        </x-form.group>
                                        <x-form.group label="Описание задачи">
                                            <x-form.textarea class="text-sm" rows="4" wire:model="openedTask.description"/>
                                        </x-form.group>
                                    </div>
                                    <div class="pt-4 pb-6">
                                        <div class="flex text-sm">
                                            <a href="#" class="group inline-flex items-center font-medium text-purple-500 hover:text-purple-900">
                                                <!-- Heroicon name: solid/link -->
                                                <svg class="h-5 w-5 text-purple-500 group-hover:text-purple-900" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-2"> Copy link </span>
                                            </a>
                                        </div>
                                        <div class="mt-4 flex text-sm">
                                            <a href="#" class="group inline-flex items-center text-gray-500 hover:text-gray-900">
                                                <!-- Heroicon name: solid/question-mark-circle -->
                                                <svg class="h-5 w-5 text-gray-400 group-hover:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="ml-2"> Learn more about sharing </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-shrink-0 justify-end space-x-4 px-4 py-4">
                            <x-button icon="heroicon-s-save">Сохранить изменения</x-button>
                            <x-button color="secondary" icon="heroicon-s-check">Выполнено!</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
