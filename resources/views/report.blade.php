<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <table>
                        <tr>
                            <td>
                                <select name="month" id="month" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" onchange="updateReport()">
                                    <option value="1"  @if($month == 1 ) selected @endif>January</option>
                                    <option value="10" @if($month == 10) selected @endif>October</option>
                                    <option value="11" @if($month == 11) selected @endif>November</option>
                                    <option value="12" @if($month == 12) selected @endif>December</option>
                                </select>
                            </td>
                            <td>
                                <select name="year" id="year" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" onchange="updateReport()">
                                    <option value="2023" @if($year == 2023) selected @endif>2023</option>
                                    <option value="2024" @if($year == 2024) selected @endif>2024</option>
                                    <option value="2025" @if($year == 2025) selected @endif>2025</option>
                                </select>
                            </td>
                            <td>
                                <a href="{{ route('report.pdf') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gray-800 rounded font-semibold text-white hover:bg-gray-700 ms-2">
                                    Download PDF
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('report.excel') }}" 
                                   class="inline-flex items-center px-4 py-2 bg-gray-800 rounded font-semibold text-white hover:bg-gray-700 ms-2">
                                    Download Excel
                                </a>
                            </td>
                        </tr>
                    </table>

                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    

                    <table class="w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th>Staff Name</th>
                                @for($day = 1; $day <= $daysInMonth; $day++)
                                <th>{{ $day }}</th>
                                @endfor
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <?php $attendance = $attendances[$user->id] ?? collect(); ?> 
                                @for($day = 1; $day <= $daysInMonth; $day++)
                                    <?php 
                                    $date = Carbon\Carbon::create($year, $month, $day)->format('Y-m-d');
                                    $dayAttendance = $attendance->where('date', $date)->first();
                                    ?>
                                    <th>
                                        @if($dayAttendance && $dayAttendance->status == 'late')
                                            <span class="inline-flex px-2 text-xs leading-5 font-semibold rounded-full" style="background-color: red; color:white;">L</span>
                                        @elseif($dayAttendance)
                                            <span class="inline-flex px-2 text-xs leading-5 font-semibold rounded-full" style="background-color: green; color:white;">N</span>
                                        @else
                                            -
                                        @endif
                                    </th>
                                @endfor
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    

                    <table class="w-full border border-gray-200 divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th>#</th>
                                <th>Datetime</th>
                                <th>Staff</th>
                                <th>Clock In</th>
                                <th>Clock Out</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @php($i = 0)
                            @foreach($logs as $log)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <th>{{ $log->created_at }}</th>
                                <th>{{ $log->user->name }}</th>
                                <th>{{ $log->clock_in }}</th>
                                <th>{{ $log->clock_out }}</th>
                                <th>{{ $log->status }}</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div>
                        {{ $logs->appends($_GET)->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        
        function updateReport(){
            const month = document.getElementById('month').value;
            const year = document.getElementById('year').value;
            window.location.href = `?month=${month}&year=${year}`;
        }

    </script>
</x-app-layout>
