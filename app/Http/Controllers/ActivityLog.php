<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Controller
{
    public function index()
    {
        $logs = Activity::paginate(20);
        return view('log.index', compact('logs'));
    }
}
