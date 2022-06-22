<x-layout>
    <main>
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">


            <div class="mt-6">
                <div class="text-3xl font-semibold mb-6">
                    Ваши проекты
                </div>

                <div class="grid grid-cols-3 gap-6 px-2 md:px-0">
                    @foreach($projects as $project)
                        <x-project-card :project="$project"/>
                    @endforeach
                </div>
            </div>



        </div>
    </main>
</x-layout>
