<?php

namespace App\Http\Controllers;

use App\Models\Drone;
use App\Models\Track;
use App\Models\Legend;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class DroneController extends Controller
{
    public function index()
    {
        $drones = Drone::paginate(6);
        $counted = Drone::all();

        return view('pages.management.drones.index', compact('drones', 'counted'));
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
                'id' => 'required|unique:drones,id',
                'merk' => 'required',
                'description' => 'required',
                'image' => 'nullable|sometimes|image|mimes:png'
            ],
            [
                'id.unique' => 'the serial number already taken'
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

    public function edit(Drone $drone)
    {
        $counted = Drone::all();
        $drones = Drone::paginate(6);
        return view('pages.management.drones.edit', compact('drone', 'counted', 'drones'));
    }

    public function update(Request $request, Drone $drone)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => [
                    'required',
                    Rule::unique('drones')->ignore($drone->id),
                ],
                'image' => 'nullable|sometimes|image|mimes:png',
                'description' => 'required',
                'merk' => 'required',
            ],
            [
                'id.unique' => 'the serial number already taken'
            ]
        );
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        if ($request->image) {
            if (File::exists($drone->image)) {
                unlink($drone->image);
                $img = $request->image->store('/images/drone');
            } else {
                $img = $request->image->store('/images/drone');
            }
        } else {
            $img = $drone->image;
        }

        $drone->id = $request->id;
        $drone->image = $img;
        $drone->merk = $request->merk;
        $drone->description = $request->description;
        $drone->save();

        return redirect()->route('management.drone')->with('success', 'Berhasil Update Data Drone');
    }

    public function show(Drone $drone)
    {
        $w_awal = Track::where('drone_id', $drone->id)->orderBy('created_at', 'asc')->first();
        $w_akhir = Track::where('drone_id', $drone->id)->orderBy('created_at', 'desc')->first();
        if ($w_awal && $w_akhir) {
            $terbang = strtotime($w_akhir->created_at) - strtotime($w_awal->created_at);
        } else {
            $terbang = 0;
        }
        return view('pages.management.drones.show', compact('drone', 'terbang'));
    }

    public function destroy(Drone $drone)
    {
        $drone->delete();

        return back()->with('success', "Berhasil Hapus Data Drone");
    }
}
