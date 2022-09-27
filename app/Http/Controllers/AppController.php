<?php

namespace App\Http\Controllers;

use App\Models\Drone;
use App\Models\Track;
use App\Models\Legend;
use App\Models\Security;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AppController extends Controller
{
    public function dashboard()
    {
        $data = Drone::first();
        $latest = Track::orderBy('created_at', 'desc')->first();
        $oldest = Track::orderBy('created_at', 'asc')->first();
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
        return view('pages.index', compact('data', 'latest', 'all', 'oldest', 'counted', 'starttoend', 'legends', 'waktu', 'waktustart'));
    }

    public function setting()
    {
        $legends = Legend::all();
        $securities = Security::all();
        return view('pages.setting', compact('legends', 'securities'));
    }

    public function legends(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'logo' => 'required|image|mimes:svg,png'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $data = new Legend();
        $data->name = $request->name;
        $data->logo = $request->logo->store('images/legends/logo');
        $data->save();

        return back()->with('success', 'Berhasil Menambahkan Data Legenda');
    }

    public function editlegends(Legend $legend)
    {
        $legends = Legend::all();
        $securities = Security::all();
        return view('pages.management.legends.edit', compact('legend', 'legends', 'securities'));
    }

    public function updatelegends(Request $request, Legend $legend)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'logo' => 'required|image|mimes:png,svg'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        if ($request->logo == null) {
            $logo = $legend->logo;
        } else {
            if (File::exists($legend->logo)) {
                unlink($legend->logo);
            }
            $logo = $request->logo->store('images/legends/logo');
        }

        $legend = Legend::where('id', $legend->id)->first();
        $legend->name = $request->name;
        $legend->logo = $logo;
        $legend->save();

        return redirect()->route('setting')->with('success', 'Berhasil Update Data Legenda');
    }

    public function security(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'part' => 'required',
                'tingkat_resiko' => 'required|numeric',
                'dampak' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $data = new Security();
        $data->part = $request->part;
        $data->tingkat_resiko = $request->tingkat_resiko;
        $data->dampak = $request->dampak;
        $data->save();

        return back()->with('success', 'Berhasil Menambahkan Data Security');
    }

    public function editsecurities(Security $security)
    {
        $legends = Legend::all();
        $securities = Security::all();
        return view('pages.management.securities.edit', compact('security', 'legends', 'securities'));
    }

    public function updatesecurities(Request $request, Security $security)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'part' => 'required',
                'tingkat_resiko' => 'required|numeric',
                'dampak' => 'required'
            ]
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        $security = Security::where('id', $security->id)->first();
        $security->part = $request->part;
        $security->tingkat_resiko = $request->tingkat_resiko;
        $security->dampak = $request->dampak;
        $security->save();

        return redirect()->route('setting')->with('success', 'Berhasil Update Data Security Status');
    }
}
