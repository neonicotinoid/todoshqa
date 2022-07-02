<x-layout>
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <div class="flex items-center">
                    <img class="w-8 h-8 mr-2" src="{{asset('css/bulb.png')}}">
                    <h1 class="text-xl md:text-3xl font-bold text-gray-900">
                        Ваш день
                    </h1>
                </div>
            </div>
        </header>

        <livewire:my-day-tasks-page :user="auth()->user()"/>
</x-layout>
