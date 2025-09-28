<x-app-layout>
    <x-slot name="header">
         <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit akun') }}
        </h2>
    </x-slot>

    <div class="py-10 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6">
            <form method="POST" action="{{ route('users.update', $user) }}" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-gray-700 dark:text-gray-200 mb-2">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-200 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 shadow-sm" required>
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-200 mb-2">Role</label>
                    <select name="role"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 shadow-sm" required>
                        <option value="guru" {{ $user->role == 'guru' ? 'selected' : '' }}>Guru</option>
                        <option value="siswa" {{ $user->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-200 mb-2">Password (opsional)</label>
                    <input type="password" name="password"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 shadow-sm">
                </div>

                <div>
                    <label class="block text-gray-700 dark:text-gray-200 mb-2">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full border rounded-xl px-4 py-3 focus:ring-2 focus:ring-green-500 shadow-sm">
                </div>

                <div class="flex gap-4">
                    <button type="submit"
                        class="px-6 py-3 bg-green-600 text-white rounded-xl shadow hover:bg-green-700 transition">
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('users') }}"
                        class="px-6 py-3 bg-gray-500 text-white rounded-xl shadow hover:bg-gray-600 transition">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
