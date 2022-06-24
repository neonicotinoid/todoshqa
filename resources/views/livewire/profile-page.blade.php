<div>
    <div class="text-3xl mt-6 font-semibold mb-6">
        Ваш профиль
    </div>
    <div class="bg-white shadow rounded-lg mt-6 p-4">
        <form wire:submit.prevent="saveUser">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 md:gap-x-6">
                <div>
                    <x-form.group label="Имя пользователя" wire:ignore>
                        <x-form.text wire:model="user.name"/>
                    </x-form.group>
                    <div class="h-4 text-sm text-red-600">
                        @error('user.name')
                            {{ $message }}
                        @enderror
                    </div>
                </div>

                <div>
                    <x-form.group label="Ваш email" wire:ignore>
                        <x-form.text wire:model="user.email" name="email"/>
                    </x-form.group>
                    <div class="h-5 text-sm text-red-600">
                        @error('user.email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>


            <div>
                <div class="text-xl mb-4 mt-8 border-b border-gray-100 text-gray-800 font-semibold">
                    Изменить пароль
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 md:gap-x-6">
                    <div>
                        <x-form.group label="Новый пароль" wire:ignore>
                            <x-form.text wire:model="newPassword"/>
                        </x-form.group>
                        <div class="h-5 text-sm text-red-600">
                            @error('newPassword')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <x-form.group label="Подтвердите новый пароль" wire:ignore>
                        <x-form.text wire:model="newPassword_confirmation"/>
                    </x-form.group>
                </div>

            </div>

            <div class="mt-6">
                <x-button class="w-full md:w-auto">Обновить данные</x-button>
            </div>
        </form>
    </div>
</div>
