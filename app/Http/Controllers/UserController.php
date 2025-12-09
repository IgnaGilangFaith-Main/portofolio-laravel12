<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $data = Auth::user();

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
            'new_password' => 'nullable|min:6',
            'new_password_confirmation' => 'nullable|same:new_password|required_with:new_password',
        ], [
            'name.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Email harus berformat email!',
            'email.unique' => 'Email sudah terdaftar, silahkan gunakan email lain!',
            'new_password.min' => 'Password harus minimal :min karakter!',
            'new_password_confirmation.same' => 'Konfirmasi password harus sama dengan password baru!',
            'new_password_confirmation.required_with' => 'Konfirmasi password wajib diisi jika password baru diisi!',
        ]);

        $user = User::findOrFail($id);

        $email_verified = $user->email_verified_at ? $user->email_verified_at : Carbon::now();

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'email_verified_at' => $email_verified,
            'password' => $request->new_password ? bcrypt($request->new_password) : $user->password,
        ];

        try {
            $user->update($data);
            sweetalert()->success('Data berhasil diupdate!');

            return redirect('/pengaturan-akun');
        } catch (Exception $e) {
            \Log::error('Gagal mengupdate user: '.$e->getMessage());
            sweetalert()->error('Gagal mengupdate data.');

            return back()->withInput();
        }
    }
}
