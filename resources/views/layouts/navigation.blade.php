<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                    </a>
                </div>

                <!-- Navigation Links (Desktop) -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                 @if(Auth::user()->role === 'admin')
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('admin.dashboard')">
                        {{ __('Dashboard Admin') }}
                    </x-nav-link>
                    <x-nav-link :href="route('users')" :active="request()->routeIs('admin.data_siswa')">
                        {{ __('Manajemen Akun') }}
                    </x-nav-link>
                    <x-nav-link :href="route('banksoal.index')" :active="request()->routeIs('admin.data_siswa')">
                        {{ __('Bank Soal') }}
                    </x-nav-link>
                    
                    <!-- Dropdown Master Data -->
        <!-- Dropdown Master Data -->
            <div class="relative group">
                <button
                    class="inline-flex items-center px-3 pt-1 border-b-2 border-transparent text-sm 
                        font-medium leading-5 text-gray-500 dark:text-gray-300 
                        hover:text-gray-700 dark:hover:text-gray-100 hover:border-gray-300 
                        focus:outline-none transition h-full">
                    {{ __('Master Data') }}
                    <svg class="ml-1 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" 
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                            d="M19 9l-7 7-7-7" />
                    </svg>
                </button>


            <!-- Dropdown Menu -->
            <div class="absolute left-0 mt-2 w-40 bg-white rounded-md shadow-lg opacity-0 
                        group-hover:opacity-100 transition-opacity duration-200 z-50">
                <a href="#" 
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    {{ __('Data Siswa') }}
                </a>
                <a href="#" 
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                    {{ __('Data Guru') }}
                </a>
            </div>
        </div>

                @elseif(Auth::user()->role === 'guru')
                    <x-nav-link :href="route('guru.dashboard')" :active="request()->routeIs('guru.dashboard')">
                        {{ __('Dashboard Guru') }}
                    </x-nav-link>
                    <x-nav-link :href="route('guru.mata_pelajaran')" :active="request()->routeIs('guru.mata_pelajaran')">
                        {{ __('Mata Pelajaran') }}
                    </x-nav-link>
                    <x-nav-link :href="route('guru.profile')" :active="request()->routeIs('guru.profile')">
                        {{ __('Profile') }}
                    </x-nav-link>

                @elseif(Auth::user()->role === 'siswa')
                    <x-nav-link :href="route('siswa.dashboard')" :active="request()->routeIs('siswa.dashboard')">
                        {{ __('Dashboard Siswa') }}
                    </x-nav-link>
                    <x-nav-link :href="route('siswa.profile')" :active="request()->routeIs('siswa.profile')">
                        {{ __('Profile') }}
                    </x-nav-link>
                @endif

                </div>
            </div>

            <!-- Settings Dropdown (Desktop) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        @if(Auth::user()->role === 'admin')
                            <x-dropdown-link :href="route('admin.profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        @elseif(Auth::user()->role === 'guru')
                            <x-dropdown-link :href="route('guru.profile')">{{ __('Profile') }}</x-dropdown-link>
                        @elseif(Auth::user()->role === 'siswa')
                            <x-dropdown-link :href="route('siswa.profile')">{{ __('Profile') }}</x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger (Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = true" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Sidebar -->
    <div x-show="open" class="fixed inset-0 z-40 flex sm:hidden" x-transition>
        <!-- Overlay -->
        <div class="fixed inset-0 bg-black bg-opacity-50" @click="open = false"></div>

        <!-- Sidebar Panel -->
        <div class="relative w-64 bg-white dark:bg-gray-800 shadow-xl h-full flex flex-col p-6 transform transition-transform duration-300"
             x-show="open"
             x-transition:enter="translate-x-0"
             x-transition:leave="-translate-x-full">

            <!-- Close Button -->
            <button @click="open = false" class="absolute top-4 right-4 text-gray-600 dark:text-gray-300">
                ✕
            </button>

            <!-- User Info -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 capitalize">{{ Auth::user()->role }}</p>
            </div>

            <!-- Sidebar Menu -->
            <nav class="flex-1 space-y-2">
               @if(Auth::user()->role === 'admin')
                <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('users') }}" class="block px-3 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">
                    {{ __('Akun') }}
                </a>
                <a href="{{ route('banksoal.index') }}" class="block px-3 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">
                    {{ __('Bank Soal') }}
                </a>

                <!-- Dropdown Master Data Mobile -->
                <div x-data="{ openMaster: false }">
                    <button @click="openMaster = !openMaster"
                        class="flex items-center w-full px-3 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">
                        <span class="flex-1 text-left">Master Data</span>
                        <svg class="w-4 h-4 ml-2 transform transition-transform"
                            :class="{ 'rotate-180': openMaster }"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    <div x-show="openMaster" x-transition class="ml-4 space-y-1">
                        <a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">
                            {{ __('Data Guru') }}
                        </a>
                        <a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">
                            {{ __('Data Siswa') }}
                        </a>
                        <a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">
                            {{ __('Kelas') }}
                        </a>
                        <a href="#" class="block px-3 py-2 rounded-md hover:bg-gray-200 dark:hover:bg-gray-700">
                            {{ __('Jurusan') }}
                        </a>
                    </div>
                </div>
            @endif


            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                @csrf
                <button type="submit" class="w-full px-3 py-2 text-left rounded-md bg-red-500 text-white hover:bg-red-600">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</nav>
