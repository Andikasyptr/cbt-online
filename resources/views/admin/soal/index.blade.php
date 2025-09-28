<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Bank Soal') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12" x-data="{ openModal: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Tombol tambah -->
            <div class="flex justify-end">
                <button 
                    @click="openModal = true"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700">
                    + Tambah Bank Soal
                </button>
            </div>

            <!-- Tabel daftar soal -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full border border-gray-300 text-sm sm:text-base">
                        <thead class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-3 border text-left">No</th>
                                <th class="px-4 py-3 border text-left">Nama Soal</th>
                                <th class="px-4 py-3 border text-left">Kelas</th>
                                <th class="px-4 py-3 border text-left">Jurusan</th>
                                <th class="px-4 py-3 border text-left">Waktu Mulai</th>
                                <th class="px-4 py-3 border text-left">Waktu Selesai</th>
                                <th class="px-4 py-3 border text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                            @forelse($banksoals as $index => $soal)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                    <td class="px-4 py-2 text-center">{{ $index + 1 }}</td>
                                    <td class="px-4 py-2">{{ $soal->nama_soal }}</td>
                                    <td class="px-4 py-2">{{ $soal->kelas }}</td>
                                    <td class="px-4 py-2">{{ $soal->jurusan }}</td>
                                    <td class="px-4 py-2">{{ $soal->waktu_mulai }}</td>
                                    <td class="px-4 py-2">{{ $soal->waktu_selesai }}</td>
                                    <td class="px-4 py-2 text-center">
                                        <a href="#" class="text-indigo-600 hover:underline">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-4 text-center text-gray-500">
                                        Belum ada bank soal.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Modal Tambah Soal -->
        <div 
            x-show="openModal" 
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50"
            x-cloak>
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg w-full max-w-lg p-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Tambah Bank Soal</h3>

                <form method="POST" action="{{ route('banksoal.store') }}">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-700 dark:text-gray-300">Nama Soal</label>
                            <input type="text" name="nama_soal" class="w-full mt-1 border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700 dark:text-gray-300">Kelas</label>
                            <input type="text" name="kelas" class="w-full mt-1 border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700 dark:text-gray-300">Jurusan</label>
                            <input type="text" name="jurusan" class="w-full mt-1 border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700 dark:text-gray-300">Waktu Mulai</label>
                            <input type="datetime-local" name="waktu_mulai" class="w-full mt-1 border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm text-gray-700 dark:text-gray-300">Waktu Selesai</label>
                            <input type="datetime-local" name="waktu_selesai" class="w-full mt-1 border rounded-lg px-3 py-2 dark:bg-gray-700 dark:text-white">
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" @click="openModal = false" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-white dark:bg-gray-800 border-t mt-6 sm:mt-8">
        <div class="max-w-7xl mx-auto py-3 sm:py-4 px-4 sm:px-6 text-center text-xs sm:text-sm text-gray-500 dark:text-gray-400">
            &copy; {{ date('Y') }} Inovasi Digital Nusantara. All rights reserved.
        </div>
    </footer>
</x-app-layout>
