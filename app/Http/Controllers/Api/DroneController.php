<?php

namespace App\Http\Controllers\Api;

use App\Models\Code;
use App\Models\Track;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

        $code = Code::create(
            [
                'code' => $request->code_id
            ]
        );

        $data = Track::create(
            [
                'drone_id' => $request->input('drone_id'),
                'code_id' => $code->id,
                'longitude' => $request->input('longitude'),
                'latitude' => $request->input('latitude')
            ]
        );

        if ($data) {
            return response()->json(
                [
                    'success' => true,
                    'message' => 'Data Added!',
                    'latitude' => $data->latitude,
                    'longitude' => $data->longitude
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
