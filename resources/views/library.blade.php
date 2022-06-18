<x-layout>
    <div class="max-w-7xl space-y-8 mx-auto py-6 sm:px-6 lg:px-8">

        <div>
            <h2 class="text-3xl font-bold mb-4">Buttons</h2>
            <div class="space-y-2">

                <div class="flex space-x-4">
                    <x-button size="xs" color="primary" icon="heroicon-s-cube">Button</x-button>
                    <x-button size="xs" color="secondary" icon="heroicon-s-cube">Button</x-button>
                    <x-button size="xs" color="white" icon="heroicon-s-cube">Button</x-button>
                </div>

                <div class="flex space-x-4">
                    <x-button size="sm" color="primary" icon="heroicon-s-cube">Button</x-button>
                    <x-button size="sm" color="secondary" icon="heroicon-s-cube">Button</x-button>
                    <x-button size="sm" color="white" icon="heroicon-s-cube">Button</x-button>
                </div>

                <div class="flex space-x-4">
                    <x-button color="primary" icon="heroicon-s-cube">Button</x-button>
                    <x-button color="secondary" icon="heroicon-s-cube">Button</x-button>
                    <x-button color="white" icon="heroicon-s-cube">Button</x-button>
                </div>

                <div class="flex space-x-4">
                    <x-button size="lg" color="primary" icon="heroicon-s-cube">Button</x-button>
                    <x-button size="lg" color="secondary" icon="heroicon-s-cube">Button</x-button>
                    <x-button size="lg" color="white" icon="heroicon-s-cube">Button</x-button>
                </div>

                <div class="flex space-x-4">
                    <x-button size="xl" color="primary" icon="heroicon-s-cube">Button</x-button>
                    <x-button size="xl" color="secondary" icon="heroicon-s-cube">Button</x-button>
                    <x-button size="xl" color="white" icon="heroicon-s-cube">Button</x-button>
                </div>

                <div class="flex space-x-4">
                    <x-button size="xl" color="primary" icon="heroicon-s-cube" icon-on="right">Button</x-button>
                    <x-button size="xl" color="secondary" icon="heroicon-s-cube" icon-on="right">Button</x-button>
                    <x-button size="xl" color="white" icon="heroicon-s-cube">Button</x-button>
                </div>

                <div class="flex space-x-4">
                    <x-button color="primary" icon="heroicon-s-cube" icon-on="right" disabled>Button</x-button>
                    <x-button color="secondary" icon="heroicon-s-cube" icon-on="right" disabled>Button</x-button>
                    <x-button color="white" icon="heroicon-s-cube" disabled>Button</x-button>
                </div>



            </div>
        </div>


        <div>
            <h2 class="text-3xl font-bold mb-4">Datepicker</h2>

            <div class="space-y-2">
                <x-form.datepicker/>
                <x-form.group label="Пример поля для выбора даты">
                    <x-form.datepicker/>
                </x-form.group>
            </div>
        </div>


        <div>
            <h2 class="text-3xl font-bold mb-4">Text input</h2>

            <div class="space-y-2">
                <x-form.group label="Text input label">
                    <x-form.text />
                </x-form.group>

                <x-form.group label="Disabled text input">
                    <x-form.text disabled/>
                </x-form.group>
            </div>
        </div>

        <div>
            <h2 class="text-3xl font-bold mb-4">Textarea</h2>

            <div class="space-y-2">
                <x-form.group label="Textarea label">
                    <x-form.textarea></x-form.textarea>
                </x-form.group>

                <x-form.group label="Textarea disabled">
                    <x-form.textarea disabled></x-form.textarea>
                </x-form.group>
            </div>
        </div>

        <div>
            <h2 class="text-3xl font-bold mb-4">Checkbox</h2>

            <div class="space-y-2">
                <x-form.checkbox label="Checkbox label"/>
            </div>
        </div>

        <div>
            <h2 class="text-3xl font-bold mb-4">Single Radio button</h2>

            <div class="space-y-2">
                <x-form.radio label="Checkbox label"/>
            </div>
        </div>

        <div>
            <h2 class="text-3xl font-bold mb-4">Radio buttons set</h2>

            <div class="space-y-2">
                <x-form.group label="Выберите тарифный план" tip="How do you prefer to receive notifications?" fieldset>
                    <div class="flex flex-col mt-2 space-y-1 items-start">
                        <x-form.radio name="tarif" value="1" label="Start"/>
                        <x-form.radio name="tarif" value="2" label="Medium"/>
                        <x-form.radio name="tarif" value="3" label="Maximum"/>
                        <x-form.radio name="tarif" value="4" label="Corporative"/>
                    </div>
                </x-form.group>
            </div>
        </div>

    </div>
</x-layout>
