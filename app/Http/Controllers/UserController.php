<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = User::where('id', $user->id)->first();

        return view('back.user.index', compact('data'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('back.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'new_password' => 'nullable|min:6|same:new_password_confirmation|required_with:new_password_confirmation',
            'new_password_confirmation' => 'required_with:new_password',
        ], [
            'name.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Email harus berformat email!',
            'email.unique' => 'Email sudah terdaftar, silahkan gunakan email lain!',
            'new_password.required_with' => 'Password harus diisi!',
            'new_password.same' => 'Password harus sama dengan Konfirmasi Password!',
            'new_password.min' => 'Password harus minimal :min karakter!',
            'new_password_confirmation.required_with' => 'Konfirmasi Password harus diisi!',
        ]);

        $user = User::findOrFail($id);

        $email_verified = $user->email_verified_at ? $user->email_verified_at : Carbon::now();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $email_verified,
            'password' => $request->new_password ? bcrypt($request->new_password) : $user->password,
        ];

        $user->update($data);
        sweetalert()->success('Data berhasil diupdate!');

        return redirect('/pengaturan-akun');
    }
}
