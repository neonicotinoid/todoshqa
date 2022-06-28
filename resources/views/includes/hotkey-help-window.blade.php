<div x-data="{isOpen: false}"
     @open-keyboard-help.window="isOpen = true"
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
                            Горячие клавиши
                        </h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            Используйте
                            <x-key>Tab</x-key>
                            для того, чтобы переключать фокус по разным элементам приложения. Выбранный элемент подсвечивается синей рамкой.
                        </div>

                        <div>
                            Для того, чтобы перелистывать выбранные задачи, вы можете использовать стрелочки
                            <x-key>↑</x-key> <x-key>↓</x-key> на клавиатуре.
                        </div>

                        <div>
                            <x-key>Пробел</x-key> откроет подробное всплывающее окно с информацией о задаче.
                            <x-key>Enter</x-key> переключит статус задачи в "Выполнено".
                        </div>


                        <div>
                            Сокращение
                            <x-key>Ctrl</x-key>
                            +
                            <x-key>Shift</x-key>
                            +
                            <x-key>N</x-key>
                            перекинет фокус на добавление новой задачи.
                            После того, как введёте название задачи, нажмите <x-key>Enter</x-key> – это добавит новую задачу в список.
                        </div>

                        <div>
                            <x-key>Esc</x-key> закроет любое всплыващее окно.
                        </div>

                        <div>
                            <x-key>Ctrl</x-key> + <x-key>Shift</x-key> + <x-key>D</x-key> скроет или покажет законченные задачи в текущем проекте.
                        </div>

                    </div>

                    <div class="mt-6">
                        <x-button @click="isOpen = false" class="w-full">Ок, закрыть</x-button>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
