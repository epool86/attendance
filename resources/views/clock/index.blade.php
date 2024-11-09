<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clocl In/Out') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Success Message with better styling --}}
            @if(session('message'))
            <div class="mb-4 relative">
                <div class="p-4 rounded-md shadow-sm border border-emerald-200 bg-emerald-50">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Heroicon check-circle -->
                            <svg class="h-5 w-5 text-emerald-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-emerald-800">
                                {{ session('message') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            {{-- Users Table with proper borders --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    Content here
                </div>
            </div>
        </div>
    </div>
</x-app-layout>