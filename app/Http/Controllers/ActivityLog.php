<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLog extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $logs = Activity::where('description', 'LIKE', '%' . $request->search . '%')
                ->orWhere('causer_id', 'LIKE', '%' . $request->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate(25);
        } else {
            $logs = Activity::orderBy('created_at', 'desc')->paginate(25);
        }
        return view('log.index', compact('logs'));
    }
}
