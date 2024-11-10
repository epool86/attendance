<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clock In/Out') }}
        </h2>
    </x-slot>

    <style type="text/css">
        .disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
    </style>

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
                <div class="p-6 text-gray-900 text-center">
                    
                    <h2 style="font-size: 30px">{{ date('d/m/Y') }}</h2>
                    <h2 style="font-size: 30px" id="live_clock"></h2>

                    <hr><br>

                    @if(!$attendance->clock_in)
                    <a href="{{ route('clock.getIn') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-800 rounded font-semibold text-white hover:bg-gray-700">
                        Clock In
                    </a>
                    @else
                    <a href="" 
                       class="inline-flex items-center px-4 py-2 bg-gray-800 rounded font-semibold text-white hover:bg-gray-700 disabled">
                        Clock In
                    </a>
                    @endif

                    @if($attendance->clock_in && !$attendance->clock_out)
                    <a href="{{ route('clock.getOut') }}" 
                        class="inline-flex items-center px-4 py-2 bg-red-600 rounded font-semibold text-white hover:bg-red-700">
                        Clock Out
                    </a>
                    @else
                    <a href="" 
                        class="inline-flex items-center px-4 py-2 bg-red-600 rounded font-semibold text-white hover:bg-red-700 disabled">
                        Clock Out
                    </a>
                    @endif

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function updateClock(){
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('live_clock').textContent = `${hours}:${minutes}:${seconds}`;
        }    
        updateClock();
        setInterval(updateClock, 1000);
    </script>

</x-app-layout>