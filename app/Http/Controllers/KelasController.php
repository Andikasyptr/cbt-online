<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Tampilkan daftar kelas.
     */
    public function index()
    {
        // nanti ambil data kelas dari model
        return view('admin.kelas.index');
    }

    /**
     * Form tambah kelas.
     */
    public function create()
    {
        return view('admin.kelas.create');
    }

    /**
     * Simpan data kelas baru.
     */
    public function store(Request $request)
    {
        // validasi
        $request->validate([
            'nama_kelas' => 'required|string|max:100|unique:kelas,nama_kelas',
        ]);

        // simpan data (nanti pakai model Kelas)
        // Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil ditambahkan.');
    }

    /**
     * Tampilkan detail kelas.
     */
    public function show($id)
    {
        return view('admin.kelas.show');
    }

    /**
     * Form edit kelas.
     */
    public function edit($id)
    {
        return view('admin.kelas.edit');
    }

    /**
     * Update data kelas.
     */
    public function update(Request $request, $id)
    {
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil diperbarui.');
    }

    /**
     * Hapus data kelas.
     */
    public function destroy($id)
    {
        return redirect()->route('kelas.index')->with('success', 'Data kelas berhasil dihapus.');
    }
}
