<x-layout>

    <main>
        <div class="max-w-7xl mx-auto px-2 py-6 sm:px-6 lg:px-8">
            <livewire:profile-page :user="auth()->user()" />
        </div>
    </main>

</x-layout>
