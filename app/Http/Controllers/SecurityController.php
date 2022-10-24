<?php

namespace App\Http\Controllers;

use App\Models\Security;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SecurityController extends Controller
{
    public function index()
    {
        $securities = Security::paginate(6);

        return view('pages.management.securities.index', compact('securities'));
    }

    public function store(Request $request)
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

    public function edit(Security $security)
    {
        $securities = Security::paginate(6);
        return view('pages.management.securities.edit', compact('security', 'securities'));
    }

    public function update(Request $request, Security $security)
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

        return redirect()->route('management.security')->with('success', 'Berhasil Update Data Security Status');
    }

    public function destroy(Security $security)
    {
        $security->delete();

        return redirect()->route('management.security')->with('success', 'Berhasil Hapus Data');
    }
}
