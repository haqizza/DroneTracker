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
                'code_id' => 'required',
                'latitude' => 'required',
                'longitude' => 'required'
            ]
        );

        if ($validators->fails()) {
            return response()->json($validators->errors());
        }

        $check = Track::where('id', 1)->exists();

        $track = new Track();
        $track->drone_id = $request->input('drone_id');
        $code_check = Code::where('id', $request->code_id)->exists();
        if ($code_check) {
            $thecode = $request->code_id;
        } else {
            $code = new Code();
            $code->id = $request->code_id;
            $code->save();
            $thecode = $code->id;
        }
        $track->code_id = $thecode;
        $track->latitude = $request->input('latitude');
        $track->longitude = $request->input('longitude');
        $track->altitude = $request->input('altitude');
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

            $track->haversine = $angle * 6371;
        } else {
            $track->haversine = 0;
        }
        if ($check) {
            $mentah = Track::orderBy('created_at', 'desc')->first();
            $waktu = (strtotime(Carbon::now()) - strtotime($mentah->created_at)) / 3600;
            $jarak = $track->haversine;
            if ($jarak > 0.00000000) {
                $hasil = $jarak / $waktu;
            } else {
                $hasil = 0;
            }
        } else {
            $hasil = 0;
        }
        $security_check = Security::where('id', $request->security_id)->exists();
        $track->speed = $hasil;
        $track->g_roll = $request->g_roll;
        $track->g_pitch = $request->g_pitch;
        $track->tegangan = $request->tegangan;
        if ($request->security_id) {
            if ($security_check) {
                $track->security_id = $request->security_id;
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Security ID Invalid'
                    ]
                );
            }
        }

        $track->save();

        event(new Tracker($track));
        if ($track->security_id) {
            if ($security_check) {
                event(new SecurityEvent($track->security->part, $track->security->tingkat_resiko, $track->security->dampak));
            } else {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Security ID Invalid'
                    ]
                );
            }
        }

        if ($track) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data Added!',
                    'data' => $track
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
