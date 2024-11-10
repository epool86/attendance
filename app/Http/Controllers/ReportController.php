<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Department;
use App\Models\Attendance;

use Carbon\Carbon;

use PDF;

use App\Exports\AttendanceExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function report(Request $request)
    {
        $month = $request->query('month', date('m'));
        $year = $request->query('year', date('Y'));

        $daysInMonth = Carbon::create($year, $month)->daysInMonth;
        $users = User::all();

        $attendances = Attendance::whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->get()
                            ->groupBy('user_id');
        $logs = Attendance::whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->paginate(5);

        return view('report', compact('month','year','daysInMonth','users','attendances','logs'));
    }

    public function reportPDF(Request $request)
    {
        $month = $request->query('month', date('m'));
        $year = $request->query('year', date('Y'));

        $daysInMonth = Carbon::create($year, $month)->daysInMonth;
        $users = User::all();

        $attendances = Attendance::whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->get()
                            ->groupBy('user_id');
        $logs = Attendance::whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->get();

        $pdf = PDF::loadView('pdf.report', compact('month','year','daysInMonth','users','attendances','logs'));
        $pdf->setPaper('a4', 'landscape');

        $path = storage_path('app/public/reports');
        if(!file_exists($path)){
            mkdir($path, 0777, true);
        }

        $filename = $path . '/' . 'attendance_report_'.time().'.pdf';

        //return $pdf->download('attendance_report.pdf');
        return $pdf->stream('attendance_report.pdf');
        //$pdf->save($filename);
        //return $filename;

    }

    public function reportExcel(Request $request)
    {
        $month = $request->query('month', date('m'));
        $year = $request->query('year', date('Y'));

        $daysInMonth = Carbon::create($year, $month)->daysInMonth;
        $users = User::all();

        $attendances = Attendance::whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->get()
                            ->groupBy('user_id');
        $logs = Attendance::whereMonth('date', $month)
                            ->whereYear('date', $year)
                            ->get();

        $filename = 'attendance_report_' . time() . '.xlsx';

        return Excel::download(
            new AttendanceExport($month, $year), 
            $filename
        );
        

    }
}
