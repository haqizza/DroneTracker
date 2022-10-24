<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserManagementController extends Controller
{
    public function index()
    {
        $users = User::paginate(6);
        $counted = User::all();
        return view('pages.management.users.index', compact('users', 'counted'));
    }

    public function create()
    {
        return view('pages.management.users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'email' => 'required|unique:users,email|email',
                'image' => 'nullable|sometimes|image',
                'password' => [
                    'nullable',
                    Password::min(8)->mixedCase()->numbers()->symbols(),
                ]
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        if ($request->image) {
            $img = $request->image->store('/images/user' . $request->name . '/profilepicture');
        } else {
            $img = '/images/userdefault.png';
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $img;
        $user->password = bcrypt($request->password);
        $user->save();

        return redirect()->route('management.user')->with('success', 'Berhasil Menambahkan Akun User');
    }

    public function edit(User $user)
    {
        $users = User::paginate(6);
        $counted = User::all();
        return view('pages.management.users.edit', compact('user', 'users', 'counted'));
    }

    public function update(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'image' => 'nullable|image|sometimes',
                'password' => [
                    'nullable',
                    'sometimes',
                    Password::min(8)->mixedCase()->numbers()->symbols(),
                ],
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
            ]
        );

        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        if ($request->image) {
            if (File::exists($user->image)) {
                unlink($user->image);
                $img = $request->image->store('/images/user' . $user->name . '/profilepicture');
            } else {
                $img = $request->image->store('/images/user' . $user->name . '/profilepicture');
            }
        } else {
            $img = $user->image;
        }

        if ($request->password) {
            $pass = bcrypt($request->password);
        } else {
            $pass = $user->password;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $pass;
        $user->image = $img;
        $user->save();

        return redirect()->route('management.user')->with('success', 'Berhasil Update Data User');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back()->with('success', 'Berhasil Delete Data User');
    }
}
