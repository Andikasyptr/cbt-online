<?php

namespace App\Http\Controllers\Admin; // sesuaikan folder

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsersImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnError
{
    use SkipsErrors;

    /**
     * Buat model User dari baris Excel
     */
    public function model(array $row)
    {
        $role = strtolower(trim($row['role'] ?? ''));

        if (!in_array($role, ['guru', 'siswa'])) {
            // Abaikan baris ini atau bisa lempar exception
            throw new \Exception("Role tidak valid di baris: {$row['row']}. Gunakan 'guru' atau 'siswa'");
        }

        return new User([
            'name'     => $row['name'],
            'email'    => $row['email'],
            'password' => Hash::make((string) $row['password']),
            'role'     => $role,
        ]);
    }

    /**
     * Validasi kolom Excel
     */
    public function rules(): array
    {
        return [
            '*.name'     => 'required|string|max:255',
            '*.email'    => 'required|email|unique:users,email',
            '*.password' => 'required|min:8',
            '*.role'     => 'required|in:guru,siswa',
        ];
    }

    /**
     * Pesan error kustom
     */
    public function customValidationMessages()
    {
        return [
            '*.name.required'     => 'Nama wajib diisi.',
            '*.email.required'    => 'Email wajib diisi.',
            '*.email.email'       => 'Format email tidak valid.',
            '*.email.unique'      => 'Email sudah terdaftar.',
            '*.password.required' => 'Password wajib diisi.',
            '*.password.min'      => 'Password minimal 8 karakter.',
            '*.role.required'     => 'Role wajib diisi.',
            '*.role.in'           => 'Role harus guru atau siswa.',
        ];
    }
}
