<?php

namespace App\Http\Controllers;

use App\Models\Legend;
use App\Models\Security;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class LegendController extends Controller
{
    public function index()
    {
        $legends = Legend::paginate(6);

        return view('pages.management.legends.index', compact('legends'));
    }

    public function store(Request $request)
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

        return redirect()->route('management.legend')->with('success', 'Berhasil Menambahkan Data Legenda');
    }

    public function edit(Legend $legend)
    {
        $legends = Legend::paginate(6);
        return view('pages.management.legends.edit', compact('legend', 'legends'));
    }

    public function update(Request $request, Legend $legend)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'logo' => 'nullable|sometimes|image|mimes:png,svg'
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

        return redirect()->route('management.legend')->with('success', 'Berhasil Update Data Legenda');
    }

    public function destroy(Legend $legend)
    {
        $legend->delete();

        return back()->with('success', 'Berhasil Hapus Data Legend');
    }
}
