<div>
    <div class="text-3xl mt-6 font-semibold mb-6">
        Ваш профиль
    </div>

    <form wire:submit.prevent="saveUser" class="grid grid-cols-1 md:grid-cols-4 gap-y-6 md:gap-y-0 md:gap-x-6">
        <div class="col-span-3 bg-white shadow rounded-lg p-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 md:gap-x-6">
                <div>
                    <x-form.group label="Имя пользователя" wire:ignore>
                        <x-form.text wire:model.defer="user.name"/>
                    </x-form.group>
                    <div class="h-4 text-sm text-red-600">
                        @error('user.name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>

                <div>
                    <x-form.group label="Ваш email" wire:ignore>
                        <x-form.text wire:model.defer="user.email" name="email"/>
                    </x-form.group>
                    <div class="h-5 text-sm text-red-600">
                        @error('user.email')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div>
                <div class="text-xl mb-4 mt-2 border-b border-gray-100 text-gray-800 font-semibold">
                    Изменить пароль
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6 md:gap-x-6">
                    <div>
                        <x-form.group label="Новый пароль" wire:ignore>
                            <x-form.text wire:model.defer="newPassword"/>
                        </x-form.group>
                        <div class="h-5 text-sm text-red-600">
                            @error('newPassword')
                            {{ $message }}
                            @enderror
                        </div>
                    </div>
                    <x-form.group label="Подтвердите новый пароль" wire:ignore>
                        <x-form.text wire:model.defer="newPassword_confirmation"/>
                    </x-form.group>
                </div>

            </div>
            <x-button class="w-full md:w-auto">Обновить данные</x-button>
        </div>

        <div class="col-span-1">
            <div class="bg-white shadow rounded-lg p-4 h-full" x-data>
                <div class="text-xl mb-4 border-b border-gray-100 text-gray-800 font-semibold">
                    Фото профиля
                </div>
                <div class="text-center">
                    @if($this->preloadedAvatar)
                        <div class="relative inline-block mx-auto w-24 h-24 mb-4 rounded-full">
                        <img alt="{{$user->name}}" class="inline-block mx-auto w-24 h-24 rounded-full"
                             src="{{ $this->preloadedAvatar->temporaryUrl() }}">
                        </div>
                    @else
                    @if($this->currentAvatar)
                        <div class="relative inline-block mx-auto w-24 h-24 mb-4 rounded-full">
                            <img alt="{{$user->name}}" class="inline-block mx-auto w-24 h-24 rounded-full" src="{{ $this->currentAvatar->getUrl() }}">
                            <button wire:click.prevent="removeAvatar" class="p-1 bg-red-50 text-red-500 border border-red-500 shadow-lg absolute right-0 bottom-1 rounded-full">
                                <x-heroicon-s-trash class="w-5 h-5"/>
                            </button>
                        </div>
                    @else
                        <x-initial-circle class="w-24 h-24 inline-block mx-auto mb-4 rounded-full" :user-id="$user->id" :text="$user->name"/>
                    @endif
                    @endif
                    <div class="ml-2 text-sm flex flex-col space-y-2">
                        <x-button size="xs" color="white" x-data @click.prevent="$refs.input.click()">
                            Выбрать фото...
                        </x-button>
                        @if($this->preloadedAvatar)
                            <x-button size="xs" wire:click.prevent="approvePreloadedAvatar">Загрузить</x-button>
                        @endif
                    </div>
                </div>
                <input type="file" wire:model="preloadedAvatar"  accept="image/png, image/jpeg, image/jpg, image/bmp, image/webp" x-ref="input" hidden>
                @error('preloadedAvatar')
                <div class="text-sm text-red-500 mt-4">
                    {{ $message }}
                </div>
                @enderror
                <div class="text-center mt-2">
                    <x-heroicons-loading wire:loading.inline-block
                                         wire:loading="preloadedAvatar, currentAvatar, approvePreloadedAvatar, removeAvatar"
                                         class="animate-spin mx-auto w-5 h-5 text-gray-500"/>
                </div>
            </div>
        </div>

        <div class="col-span-full md:mt-4">
            <div class="text-gray-400 text-sm">
                <div class="w-full">
                    <span class="font-medium">Вы зарегистрировались:</span> {{$user->created_at->format('M d Y')}}
                </div>
            </div>
        </div>

    </form>
</div>
