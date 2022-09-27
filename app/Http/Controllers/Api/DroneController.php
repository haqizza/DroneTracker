<?php

namespace App\Http\Controllers\Api;

use App\Events\SecurityEvent;
use App\Events\Tracker;
use App\Models\Code;
use App\Models\Track;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Security;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class DroneController extends Controller
{
    public function store(Request $request)
    {
        $validators = Validator::make(
            $request->all(),
            [
                'drone_id' => 'required',
                'code' => 'required',
                'latitude' => 'required',
                'longitude' => 'required'
            ]
        );

        if ($validators->fails()) {
            return response()->json($validators->errors());
        }

        $check = Track::where('id', 1)->exists();

        $data = new Track();
        $data->drone_id = $request->input('drone_id');
        $data->code = $request->input('code');
        $data->latitude = $request->input('latitude');
        $data->longitude = $request->input('longitude');
        $data->altitude = $request->input('altitude');
        if ($check) {
            $latest = Track::orderBy('created_at', 'desc')->first();

            $latFrom = deg2rad($latest->latitude);
            $lgnFrom = deg2rad($latest->longitude);
            $latTo = deg2rad($request->latitude);
            $lngTo = deg2rad($request->longitude);

            $latDelta = $latTo - $latFrom;
            $lgnDelta = $lngTo - $lgnFrom;

            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lgnDelta / 2), 2)));

            $data->haversine = $angle * 6371;
        } else {
            $data->haversine = 0;
        }
        if ($check) {
            $mentah = Track::orderBy('created_at', 'desc')->first();
            $waktu = (strtotime(Carbon::now()) - strtotime($mentah->created_at)) / 3600;
            $jarak = $data->haversine;
            if ($jarak > 0.00000000) {
                $hasil = $jarak / $waktu;
            } else {
                $hasil = 0;
            }
        } else {
            $hasil = 0;
        }
        $security_check = Security::where('id', $request->security_id)->exists();
        $data->speed = $hasil;
        $data->g_roll = $request->g_roll;
        $data->g_pitch = $request->g_pitch;
        $data->tegangan = $request->tegangan;
        if ($request->security_id) {
            if ($security_check) {
                $data->security_id = $request->security_id;
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Security ID Invalid'
                    ]
                );
            }
        }

        $data->save();

        event(new Tracker($data));
        if ($data->security_id) {
            if ($security_check) {
                event(new SecurityEvent($data->security->part, $data->security->tingkat_resiko, $data->security->dampak));
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Security ID Invalid'
                    ]
                );
            }
        }

        if ($data) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data Added!',
                    'data' => $data
                ],
                201
            );
        }

        return response()->json(
            [
                'success' => false,
                'message' => 'Something Went Wrong :('
            ],
            400
        );
    }
}
