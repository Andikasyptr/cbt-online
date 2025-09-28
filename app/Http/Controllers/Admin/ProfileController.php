<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use App\Models\User; 

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user(); // ambil user yang sedang login
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // email tidak boleh duplikat kecuali milik sendiri
            ],
        ]);

        /** @var User $user */
        $user->update($validated);

        return back()->with('status', 'profile-updated');
    }

    public function destroy(Request $request)
    {
        $user = Auth::user();

        // pastikan password benar sebelum hapus akun
        $request->validate([
            'password' => ['required'],
        ]);

        if (! Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Password yang anda masukkan salah.',
            ], 'userDeletion');
        }

        Auth::logout();
        /** @var User $user */
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

       return back()->with('status', 'profile-updated');

    }
}
