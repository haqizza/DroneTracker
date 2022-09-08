<?php

namespace App\Http\Controllers;

use App\Models\Drone;
use App\Models\Track;
use Illuminate\Http\Request;

class DroneController extends Controller
{
    public function dashboard()
    {
        $data = Drone::first();
        $latest = Track::orderBy('created_at', 'desc')->first();
        $oldest = Track::orderBy('created_at', 'asc')->first();
        $all = Track::all();

        return view('pages.index', compact('data', 'latest', 'all', 'oldest'));
    }
}
