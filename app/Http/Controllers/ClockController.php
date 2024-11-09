<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Department;
use App\Models\User;

class ClockController extends Controller
{
    public function get()
    {
        return view('clock.index');
    }

    public function post(Request $request)
    {

    }
}
