<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <!-- Welcome Box -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-4 sm:p-6 text-gray-900 dark:text-gray-100 text-center sm:text-left">
                   {{ __("Welcome admin, ") . Auth::user()->name . "!" }}

                </div>
            </div>

            <!-- Grid Info Akun -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">

                <!-- Total User -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-300">Total User</h3>
                    <p class="mt-2 text-2xl sm:text-3xl font-bold text-indigo-600">
                        {{ \App\Models\User::count() }}
                    </p>
                </div>

                <!-- Total Guru -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-300">Total Guru</h3>
                    <p class="mt-2 text-2xl sm:text-3xl font-bold text-blue-600">
                        {{ \App\Models\User::where('role', 'guru')->count() }}
                    </p>
                </div>

                <!-- Total Siswa -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-300">Total Siswa</h3>
                    <p class="mt-2 text-2xl sm:text-3xl font-bold text-blue-600">
                        {{ \App\Models\User::where('role', 'siswa')->count() }}
                    </p>
                </div>

                <!-- Total Siswa Login -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-300">Siswa Login</h3>
                    <p class="mt-2 text-2xl sm:text-3xl font-bold text-blue-600">
                        {{ Auth::check() && Auth::user()->role === 'siswa' ? 1 : 0 }}
                    </p>
                </div>

                <!-- Total Guru Login -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-4 sm:p-6">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-700 dark:text-gray-300">Guru Login</h3>
                    <p class="mt-2 text-2xl sm:text-3xl font-bold text-green-600">
                        {{ Auth::check() && Auth::user()->role === 'guru' ? 1 : 0 }}
                    </p>
                </div>

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
