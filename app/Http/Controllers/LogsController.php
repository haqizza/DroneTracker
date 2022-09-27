<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function user()
    {
        $logs = Log::orderBy('id','desc')->get();

        return view('pages.logs.user', compact('logs'));
    }
}
