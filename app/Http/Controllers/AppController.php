<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Code;
use App\Models\Drone;
use App\Models\Track;
use App\Models\Legend;
use App\Models\Security;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    public function dashboard(Request $request)
    {
        $data = Drone::first();
        $latest = Track::orderBy('created_at', 'desc')->first();
        $oldest = Track::orderBy('created_at', 'asc')->first();
        $codes = Code::all();
        $all = Track::all();
        $count = Track::pluck('haversine')->toArray();
        $counted = array_sum($count);
        $latFrom = deg2rad($latest->latitude ?? 0);
        $lgnFrom = deg2rad($latest->longitude ?? 0);
        $latTo = deg2rad($oldest->latitude ?? 0);
        $lngTo = deg2rad($oldest->longitude ?? 0);
        $latDelta = $latTo - $latFrom;
        $lgnDelta = $lngTo - $lgnFrom;
        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lgnDelta / 2), 2)));
        $starttoend = $angle * 6371;
        $legends = Legend::all();
        $waktustart = Track::orderBy('created_at', 'asc')->first();
        $waktuend = Track::orderBy('created_at', 'desc')->first();
        if ($waktustart && $waktuend) {
            $waktu = (strtotime($waktuend->created_at) - strtotime($waktustart->created_at));
        } else {
            $waktu = '';
        }
        return view('pages.index', compact('data', 'latest', 'all', 'oldest', 'counted', 'starttoend', 'legends', 'waktu', 'waktustart', 'codes'));
    }

    public function flightcode($id)
    {
        $code = Track::where('code_id', $id)->get();
        return response()->json($code);
    }

    public function setting()
    {
        return view('pages.setting');
    }

    public function update(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'image' => 'nullable|image|mimes:png,jpg,jpeg',
                'version' => 'required'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }


        $app = App::first();
        $app->name = $request->name;
        $app->description = $request->description;
        if ($request->image) {
            if (File::exists($app->image)) {
                unlink($app->image);
                $img = $request->image->store('images/app');
            } else {
                $img = $request->image->store('images/app');
            }
        } else {
            $img = $app->image;
        }
        $app->image = $img;
        $app->version = $request->version;
        $app->save();

        return back()->with('success', 'Berhasil Update Profile Aplikasi');
    }
}
