<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class Activity_logController extends Controller
{
    public function index()
    {
        $activityLogs = ActivityLog::orderBy('created_at', 'DESC')->paginate(10);
        return view('auditoria.index', compact('activityLogs'));
    }
}
