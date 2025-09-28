<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Admin\UsersTemplateExport;
use App\Http\Controllers\Admin\UsersImport;


class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $role   = $request->input('role');

        $query = User::whereIn('role', ['guru', 'siswa']);

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        if ($role) {
            $query->where('role', $role);
        }

        $users = $query->orderBy('name')->paginate(10);

        return view('admin.users.index', compact('users', 'search', 'role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role'     => 'required|in:guru,siswa',
        ]);

        try {
            User::create([
                'name'     => $request->name,
                'email'    => $request->email,
                'password' => $request->password, // otomatis hash via cast di model
                'role'     => strtolower($request->role),
            ]);

            return redirect()->route('users')->with('success', 'Akun berhasil ditambahkan.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat menambahkan akun: '.$e->getMessage());
        }
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'role'      => 'required|in:guru,siswa',
            'password'  => 'nullable|string|min:8|confirmed',
        ]);

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = strtolower($request->role);

            if ($request->filled('password')) {
                $user->password = $request->password;
            }

            $user->save();

            return redirect()->route('users')->with('success', 'Akun berhasil diperbarui.');
        } catch (QueryException $e) {
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan saat memperbarui akun: '.$e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users')->with('success', 'Akun berhasil dihapus.');
        } catch (QueryException $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghapus akun: '.$e->getMessage());
        }
    }

    // =========================
    // Fitur Excel
    // =========================

    // Download template Excel
    public function downloadTemplate()
    {
        return Excel::download(new UsersTemplateExport, 'template_users.xlsx');
    }

    // Import Excel
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            Excel::import(new UsersImport, $request->file('file'));
            return redirect()->back()->with('success', 'Data berhasil diimport!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: '.$e->getMessage());
        }
    }
}
