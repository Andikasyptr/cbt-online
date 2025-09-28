<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BankSoal;

class BankSoalController extends Controller
{
    /**
     * Tampilkan halaman daftar bank soal.
     */
public function index()
{
    $banksoals = \App\Models\BankSoal::orderBy('nama_soal', 'asc')->get();
    return view('admin.soal.index', compact('banksoals'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'nama_soal' => 'required|string|max:255',
        'kelas' => 'required|string|max:50',
        'jurusan' => 'required|string|max:100',
        'waktu_mulai' => 'date',
        'waktu_selesai' => 'date|after:waktu_mulai',
    ]);

    \App\Models\BankSoal::create($validated);

    return redirect()->route('banksoal.index')->with('success', 'Bank soal berhasil ditambahkan.');
}


}
