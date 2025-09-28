<x-app-layout>
    <x-slot name="header">
       <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Manajemen Akun') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">

        {{-- Notifikasi Sukses/Error --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded-lg shadow mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-700 p-4 rounded-lg shadow mb-4">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tombol Tambah Akun + Download Template + Import Excel --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">

            <div class="flex flex-col sm:flex-row items-center gap-2 w-full md:w-auto">

                {{-- Download Template --}}
                <a href="{{ route('users.downloadTemplate') }}"
                class="w-full sm:w-auto px-5 py-3 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700 transition text-center">
                    📥 Download Template
                </a>

                {{-- Import Excel --}}
                <form action="{{ route('users.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-center gap-2 w-full sm:w-auto">
                    @csrf
                    <input type="file" name="file" accept=".xlsx,.xls" required
                        class="border rounded-xl px-4 py-2 focus:ring-2 focus:ring-indigo-500 shadow-sm w-full sm:w-auto">
                    <button type="submit"
                            class="w-full sm:w-auto px-6 py-3 bg-green-600 text-white rounded-xl shadow hover:bg-green-700 transition">
                        ⬆️ Import
                    </button>
                </form>
                    {{-- Tombol Tambah Akun --}}
                    <button id="btnShowAddUser"
                        class="w-full md:w-auto px-6 py-3 bg-green-600 text-white rounded-xl shadow hover:bg-green-700 transition">
                        ➕ Tambah Akun
                    </button>
            </div>
        </div>
             {{-- Filter Akun --}}
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6">
            <h3 class="text-xl font-semibold mb-4 text-gray-700 dark:text-gray-200">🔍 Filter Akun</h3>
            <form method="GET" action="{{ route('users') }}" class="flex flex-col md:flex-row gap-4">
                <input type="text" name="search" placeholder="Cari nama..."
                    value="{{ request('search') }}"
                    class="flex-1 border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none shadow-sm">

                <select name="role"
                    class="border rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none shadow-sm">
                    <option value="">-- Semua Role --</option>
                    <option value="guru" {{ request('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="siswa" {{ request('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>

                <div class="flex gap-2">
                    <button type="submit"
                        class="px-5 py-3 bg-indigo-600 text-white rounded-xl shadow hover:bg-indigo-700 transition">
                        Filter
                    </button>
                    <a href="{{ route('users') }}"
                        class="px-5 py-3 bg-gray-500 text-white rounded-xl shadow hover:bg-gray-600 transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>


        {{-- Modal Tambah Akun --}}
        <div id="modalAddUser" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
        
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl w-full max-w-lg p-6 relative">
                <button id="btnCloseModal"
                    class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-xl font-bold">&times;</button>
                <h3 class="text-xl font-semibold mb-6 text-gray-700 dark:text-gray-200">➕ Tambah Akun Baru</h3>
                
                <form method="POST" action="{{ route('users.store') }}" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Nama --}}
                        <div>
                            <input type="text" name="name" placeholder="Nama Lengkap"
                                value="{{ old('name') }}"
                                class="border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 shadow-sm w-full">
                            @error('name')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <input type="email" name="email" placeholder="Email"
                                value="{{ old('email') }}"
                                class="border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 shadow-sm w-full">
                            @error('email')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Password --}}
                       <div class="relative">
                        <input type="password" id="password" name="password" placeholder="Password"
                            class="border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 shadow-sm w-full">
                        <button type="button" onclick="togglePassword('password')"
                            class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">👁️</button>
                        @error('password')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                        <p class="text-gray-500 text-xs mt-1">
                            Password minimal 8 karakter
                        </p>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Konfirmasi Password"
                            class="border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 shadow-sm w-full">
                        <button type="button" onclick="togglePassword('password_confirmation')"
                            class="absolute right-3 top-3 text-gray-500 hover:text-gray-700">👁️</button>
                        <p class="text-gray-500 text-xs mt-1">
                            Masukkan password yang sama 
                        </p>
                    </div>


                        {{-- Role --}}
                        <div class="md:col-span-2">
                            <select name="role"
                                class="border rounded-xl px-4 py-3 w-full focus:ring-2 focus:ring-green-500 shadow-sm">
                                <option value="">-- Pilih Role --</option>
                                <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                                <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                            </select>
                            @error('role')
                                <span class="text-red-600 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 mt-4">
                        <button type="button" id="btnCancelModal"
                            class="px-6 py-3 bg-gray-500 text-white rounded-xl shadow hover:bg-gray-600 transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-6 py-3 bg-green-600 text-white rounded-xl shadow hover:bg-green-700 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Tabel Daftar Akun --}}
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6 overflow-x-auto">
            <h3 class="text-xl font-semibold mb-6 text-gray-700 dark:text-gray-200">📋 Daftar Akun</h3>
            <table class="w-full text-sm text-left border-separate border-spacing-y-2">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 text-sm uppercase tracking-wide">
                        <th class="px-6 py-3 rounded-l-lg">Nama</th>
                        <th class="px-6 py-3">Email</th>
                        <th class="px-6 py-3">Role</th>
                        <th class="px-6 py-3 text-center rounded-r-lg">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                        <tr class="bg-gray-50 dark:bg-gray-900 hover:bg-indigo-50 dark:hover:bg-gray-700 transition rounded-xl shadow-sm">
                            <td class="px-6 py-4 font-medium">{{ $user->name }}</td>
                            <td class="px-6 py-4">{{ $user->email }}</td>
                            <td class="px-6 py-4 capitalize">
                                <span class="px-3 py-1 text-xs rounded-full 
                                    {{ $user->role == 'guru' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600' }}">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center flex justify-center gap-2">
                                <a href="{{ route('users.edit', $user) }}"
                                    class="px-3 py-2 bg-yellow-400 text-white rounded-lg shadow hover:bg-yellow-500 transition">
                                    ✏️
                                </a>

                                <button onclick="deleteUser('{{ route('users.destroy', $user) }}')"
                                    class="px-3 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition">
                                    🗑️
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4"
                                class="px-6 py-4 text-center text-gray-500 dark:text-gray-400 italic">
                                Tidak ada data.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    {{-- Script Toggle Password & Modal --}}
    <script>
        function togglePassword(id) {
            const input = document.getElementById(id);
            input.type = input.type === 'password' ? 'text' : 'password';
        }

        function deleteUser(url) {
            Swal.fire({
                title: 'Yakin?',
                text: "Akun ini akan dihapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    form.innerHTML = `@csrf @method('DELETE')`;
                    document.body.appendChild(form);
                    form.submit();
                }
            })
        }

        // Modal
        const modal = document.getElementById('modalAddUser');
        document.getElementById('btnShowAddUser').addEventListener('click', () => {
            modal.classList.remove('hidden');
        });
        document.getElementById('btnCloseModal').addEventListener('click', () => {
            modal.classList.add('hidden');
        });
        document.getElementById('btnCancelModal').addEventListener('click', () => {
            modal.classList.add('hidden');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</x-app-layout>
