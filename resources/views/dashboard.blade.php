<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <p class="text-gray-900 dark:text-gray-100 mb-4">
                    You're logged in!
                </p>

                {{-- ⭐ Add link to Books --}}
                <a href="{{ route('books.index') }}" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-lg">
                    Manage Books
                </a>

            </div>

        </div>
    </div>
</x-app-layout>
