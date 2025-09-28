<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Jurusan; // aktifkan kalau sudah bikin model Jurusan

class JurusanController extends Controller
{
    /**
     * Tampilkan daftar jurusan.
     */
    public function index()
    {
        // $jurusan = Jurusan::all();
        // return view('admin.jurusan.index', compact('jurusan'));

        return view('admin.jurusan.index'); // sementara kosong
    }

    /**
     * Form tambah jurusan.
     */
    public function create()
    {
        return view('admin.jurusan.create');
    }

    /**
     * Simpan jurusan baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:100|unique:jurusan,nama_jurusan',
        ]);

        // Jurusan::create($request->all());

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil ditambahkan.');
    }

    /**
     * Detail jurusan.
     */
    public function show(string $id)
    {
        // $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusan.show');
    }

    /**
     * Form edit jurusan.
     */
    public function edit(string $id)
    {
        // $jurusan = Jurusan::findOrFail($id);
        return view('admin.jurusan.edit');
    }

    /**
     * Update jurusan.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_jurusan' => 'required|string|max:100|unique:jurusan,nama_jurusan,' . $id,
        ]);

        // $jurusan = Jurusan::findOrFail($id);
        // $jurusan->update($request->all());

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil diperbarui.');
    }

    /**
     * Hapus jurusan.
     */
    public function destroy(string $id)
    {
        // Jurusan::destroy($id);

        return redirect()->route('jurusan.index')->with('success', 'Data jurusan berhasil dihapus.');
    }
}
