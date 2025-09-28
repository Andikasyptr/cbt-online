<?php
namespace App\Http\Controllers\Admin; // sesuaikan folder

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromArray;

class UsersTemplateExport implements FromArray, WithHeadings
{
    public function array(): array
    {
        return [
            // kosong, user akan mengisi sendiri
            [],
        ];
    }

    public function headings(): array
    {
        return ['name', 'email', 'password', 'role'];
    }
}
