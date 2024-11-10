<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

use App\Models\User;
use App\Models\Attendance;

use Carbon\Carbon;

class AttendanceExport implements FromView
{
    protected $month;
    protected $year;

    public function __construct($month, $year)
    {
        $this->month = $month;
        $this->year = $year;
    }

    public function view(): View
    {
        $month = $this->month;
        $year = $this->year;
        $daysInMonth = Carbon::create($year, $month)->daysInMonth;
        $users = User::all();
        $attendances = Attendance::whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->get()
                            ->groupBy('user_id');
        $logs = Attendance::whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->get();

        return view('excel.report', compact('month','year','daysInMonth','users','attendances','logs'));
    }
}
