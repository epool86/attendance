<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\User;
use App\Models\Attendance;

use Auth;
use Carbon\Carbon;

class ClockController extends Controller
{
    public function get()
    {
        $user = Auth::user();
        $today = Carbon::today();

        $attendance = Attendance::where('user_id', $user->id)->where('date', $today)->firstOrNew();
        return view('clock.index', compact('attendance'));
    }

    public function getIn()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $now = Carbon::now();

        $lateLimit = Carbon::createFromTimeString('13:30:00');

        $status = $now->format('H:i:s') > '13:30:00' ? 'late' : null;

        if($now < $lateLimit){
            $early_minutes = $lateLimit->diffInMinutes($now);
        } else {
            $early_minutes = null;
        }

        $attendance = Attendance::firstOrCreate([
            'user_id' => $user->id,
            'date' => $today,
        ],[
            'clock_in' => $now->format('H:i:s'),
            'early_minutes' => $early_minutes,
            'status' => $status,
        ]);

        return redirect()->route('clock.get')->with('message', 'You are successfully clocked in!');

    }

    public function getOut()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $now = Carbon::now();

        $attendance = Attendance::updateOrCreate([
            'user_id' => $user->id,
            'date' => $today,
        ],[
            'clock_out' => $now->format('H:i:s'),
        ]);

        return redirect()->route('clock.get')->with('message', 'You are successfully clocked out!');
    }
}
