<?php

namespace App\Http\Controllers;

use App\Models\Drone;
use App\Models\Track;
use App\Models\Legend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DroneController extends Controller
{
    public function index()
    {
        $drones = Drone::paginate(8);

        return view('pages.management.drones.index', compact('drones'));
    }

    public function create()
    {
        return view('pages.management.drones.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required',
                'merk' => 'required',
                'description' => 'required',
                'image' => 'nullable|sometimes|image|mimes:png'
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        if ($request->image) {
            $img = $request->image->store('/images/drone');
        } else {
            $img = '/images/drone.png';
        }

        $drone = new Drone();
        $drone->id = $request->id;
        $drone->merk = $request->merk;
        $drone->image = $img;
        $drone->description = $request->description;
        $drone->save();

        return redirect()->route('management.drone')->with('success', 'Berhasil Menambahkan Data Drone');
    }
}
