<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\Code;
use App\Models\Drone;
use App\Models\Track;
use App\Models\Legend;
use App\Models\Security;
use App\Models\TelemetriLogs;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class AppController extends Controller
{

    public function setcookie(Request $request)
    {
        $response = new Response('Set Cookie');
        $response->withCookie(cookie('setCookie','success',2147483647));
        return $response;
    }

    public function getcookie(Request $request)
    {
        $value = $request->cookie('code');
        echo $value;
    }

    public function dashboard(Request $request)
    {
        // $data = Drone::first();
        // $latest = Track::orderBy('created_at', 'desc')->first();
        // $oldest = Track::orderBy('created_at', 'asc')->first();
        // $codes = Code::all();
        // $all = Track::all();
        // $count = Track::pluck('haversine')->toArray();
        // $counted = array_sum($count);
        // $latFrom = deg2rad($latest->latitude ?? 0);
        // $lgnFrom = deg2rad($latest->longitude ?? 0);
        // $latTo = deg2rad($oldest->latitude ?? 0);
        // $lngTo = deg2rad($oldest->longitude ?? 0);
        // $latDelta = $latTo - $latFrom;
        // $lgnDelta = $lngTo - $lgnFrom;
        // $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lgnDelta / 2), 2)));
        // $starttoend = $angle * 6371;
        // $legends = Legend::all();
        // $waktustart = Track::orderBy('created_at', 'asc')->first();
        // $waktuend = Track::orderBy('created_at', 'desc')->first();
        // if ($waktustart && $waktuend) {
        //     $waktu = (strtotime($waktuend->created_at) - strtotime($waktustart->created_at));
        // } else {
        //     $waktu = '';
        // }

        $logs = TelemetriLogs::where('complete','1')->get();
        $logsCount = $logs->count();

        $oldest = TelemetriLogs::orderBy('created_at', 'asc')->first();
        $latest = TelemetriLogs::orderBy('created_at', 'desc')->first();
        $waktu = '';
        if ($oldest && $latest) {
            $waktu = (strtotime($latest->created_at) - strtotime($oldest->created_at));
        } else {
            $waktu = '';
        }

        return view('pages.index', compact('logs', 'logsCount', 'oldest', 'latest', 'waktu'));
    }

    public function predict(Request $request)
    {

        // $logs = TelemetriLogs::where('complete', '1')->get();
        $logs = TelemetriLogs::where('use', '1')->get();

        $logsCount = $logs->count();



        return view('pages.predict.index', compact('logs', 'logsCount'));
    }

    public function setPhoto(Request $request)
    {
        // TelemetriLogs::whereNotNull('photo')
        // ->update(['photo' => null]);

        $listPhoto = Storage::disk('public')->allFiles('images/photos');

        $photoPath = 'images/photos/';

        $logs = TelemetriLogs::get();

        $logsCount = $logs->count();

        $dataCount = 1;

        for ($i = 1; $i < count($listPhoto) + 1; $i++) {
            $telemetriLog = TelemetriLogs::find($dataCount);

            $telemetriLog->photo = $photoPath . $i . '.jpg';

            $telemetriLog->save();

            $dataCount += 2;
        }

        return back();
    }

    // public function flightcode($id)
    // {
    //     $code = Track::where('code_id', $id)->get();
    //     return response()->json($code);
    // }

    // public function setting()
    // {
    //     return view('pages.setting');
    // }

    // public function update(Request $request)
    // {
    //     $validator = Validator::make(
    //         $request->all(),
    //         [
    //             'name' => 'required',
    //             'description' => 'required',
    //             'image' => 'nullable|image|mimes:png,jpg,jpeg',
    //             'version' => 'required'
    //         ]
    //     );

    //     if ($validator->fails()) {
    //         return back()->withErrors($validator->errors());
    //     }


    //     $app = App::first();
    //     $app->name = $request->name;
    //     $app->description = $request->description;
    //     if ($request->image) {
    //         if (File::exists($app->image)) {
    //             unlink($app->image);
    //             $img = $request->image->store('images/app');
    //         } else {
    //             $img = $request->image->store('images/app');
    //         }
    //     } else {
    //         $img = $app->image;
    //     }
    //     $app->image = $img;
    //     $app->version = $request->version;
    //     $app->save();

    //     return back()->with('success', 'Berhasil Update Profile Aplikasi');
    // }
}
