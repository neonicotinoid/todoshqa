<div>
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8 px-2">

            <div class="mt-6">
                <div class="flex flex-col md:flex-row md:items-center justify-between mb-6">
                    <div class="text-xl md:text-3xl font-semibold mb-2 md:mb-0">
                        Ваши проекты
                    </div>
                    <x-button x-data="" icon="heroicon-s-plus" icon-on="right" size="sm" color="blue" @click="Livewire.emit('openCreateProjectWindow')">Создать проект</x-button>
                </div>

                <div class="flex flex-col space-y-4 mb-10">
                    @foreach($this->projects as $project)
                        <x-project-card :project="$project"/>
                    @endforeach
                </div>

            </div>
        </div>
    </main>

    <livewire:create-project-window/>
    <livewire:project-edit-window/>

    @include('includes.project-trash-confirm')

</div>
