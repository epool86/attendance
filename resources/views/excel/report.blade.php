<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<style type="text/css">
		table {
			width: 100%;
		}
		td, th {
			border: 1px solid #CCC;
		}
	</style>
</head>
<body>

	<h3>Status</h3>

	<table class="" cellpadding="2" cellspacing="0">
        <thead class="">
            <tr>
                <th>Staff Name</th>
                @for($day = 1; $day <= $daysInMonth; $day++)
                <th>{{ $day }}</th>
                @endfor
            </tr>
        </thead>
        <tbody class="">
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
                            <span class="" style="background-color: red; color:white;">L</span>
                        @elseif($dayAttendance)
                            <span class="" style="background-color: green; color:white;">N</span>
                        @else
                            -
                        @endif
                    </th>
                @endfor
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Logs/History</h3>

    <table class="" cellpadding="2" cellspacing="0">
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
        <tbody class="">
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

</body>
</html>