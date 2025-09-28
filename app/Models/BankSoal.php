<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankSoal extends Model
{
    use HasFactory;

    protected $table = 'bank_soals'; // pastikan nama tabel sesuai migrasi

    // semua kolom boleh diisi kecuali 'id'
    protected $guarded = ['id'];
}
