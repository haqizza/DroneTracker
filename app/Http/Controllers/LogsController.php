<?php

namespace App\Http\Controllers;

use App\Models\Code;
use App\Models\Drone;
use App\Models\Log;
use App\Models\Track;
use Illuminate\Http\Request;

class LogsController extends Controller
{
    public function user()
    {
        $logs = Log::orderBy('id', 'desc')->get();

        return view('pages.logs.user', compact('logs'));
    }

    public function drone()
    {
        $logs = Drone::all();
        $tracks = Track::all();
        $codes = Code::all();
        return view('pages.logs.drone', compact('logs', 'tracks', 'codes'));
    }

    public function fcode(Request $request, $drone, $code)
    {
        $tracks = Track::where('drone_id', $drone)->where('code_id', $code)->get();

        return response()->json($tracks);
    }

    public function alldrone($drone)
    {
        $codes = Code::where('drone_id', $drone)->get();
        $drone = Drone::where('id', $drone)->first();

        return response()->json([
            'drone' => $drone,
            'code' => $codes
        ]);
    }
}
