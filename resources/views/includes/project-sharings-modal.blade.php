<div x-data="{isOpen: @entangle('isProjectAccessModalOpen').defer}"
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
                            Настройки доступа
                        </h3>

                        <div>
                            <div class="text-sm">Владелец проекта:</div>
                            <div class="mt-1 flex items-center p-2 border border-gray-200 bg-gray-50 rounded-lg">
                                <img class="w-8 h-8 rounded-full" src="https://ui-avatars.com/api/?background=0D8ABC&color=fff">
                                <div class="ml-3 text-sm text-gray-600">
                                    <p>Tom Cook</p>
                                    <p class="text-gray-300 text-xs font-normal">It's you</p>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button
                                    class="inline-block text-purple-500 text-sm border-b border-dashed border-purple-500">
                                    Поделиться доступом к проекту
                                </button>
                            </div>

                            <div class="mt-2">
                                <x-form.group label="Введите email пользователя:">
                                    <x-form.text placeholder="user@mail.com"/>
                                </x-form.group>
                                <div class="mt-1 text-green-600 text-sm">
                                    Есть пользователь с таким email
                                </div>
                                <div class="mt-1 text-red-600 text-sm">
                                    Пользователь с таким email не зарегистрирован
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="mt-5 sm:mt-6">
                    <x-button class="w-full">Сохранить изменения</x-button>
                </div>
            </div>
        </div>
    </div>
</div>
