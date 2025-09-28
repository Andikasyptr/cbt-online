<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Tampilkan daftar guru.
     */
    public function index()
    {
        // nanti ambil data guru dari model
        return view('admin.siswa.index');
    }

    /**
     * Form tambah guru.
     */
    public function create()
    {
        return view('admin.siswa.create');
    }

    /**
     * Simpan data guru baru.
     */
    public function store(Request $request)
    {
        // validasi
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50|unique:guru',
        ]);

        // simpan data (nanti pakai model Guru)
        // Guru::create($request->all());

        return redirect()->route('guru.index')->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail guru.
     */
    public function show($id)
    {
        return view('admin.siswa.show');
    }

    /**
     * Form edit guru.
     */
    public function edit($id)
    {
        return view('admin.siswa.edit');
    }

    /**
     * Update data guru.
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Hapus data guru.
     */
    public function destroy($id)
    {
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus.');
    }
}
