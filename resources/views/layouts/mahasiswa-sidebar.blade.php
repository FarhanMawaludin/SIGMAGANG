<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-full sm:h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800 ">
        <ul class="space-y-2 font-medium ">
            <!-- Dashboard -->
            <li class="mb-4">
                <a href="{{ url('/dashboard/mahasiswa') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'dashboard' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'dashboard' ? 'text-white' : 'text-gray-400 dark:text-white' }}"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.143 4H4.857A.857.857 0 0 0 4 4.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 10 9.143V4.857A.857.857 0 0 0 9.143 4Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286A.857.857 0 0 0 20 9.143V4.857A.857.857 0 0 0 19.143 4Zm-10 10H4.857a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286A.857.857 0 0 0 9.143 14Zm10 0h-4.286a.857.857 0 0 0-.857.857v4.286c0 .473.384.857.857.857h4.286a.857.857 0 0 0 .857-.857v-4.286a.857.857 0 0 0-.857-.857Z" />
                    </svg>
                    <span
                        class="ml-3 {{ $activemenu == 'dashboard' ? 'text-white' : 'text-gray-400' }}">Dashboard</span>
                </a>
            </li>

            <!-- Manajemen Akun -->
            <li class="text-xs px-2 text-gray-800 uppercase">Manajemen Akun</li>

            <li class="mb-4">
                <a href="{{ url('/profil/mahasiswa') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'profil' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'profil' ? 'text-white' : 'text-gray-400 dark:text-white' }}"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                    <span class="ml-3 {{ $activemenu == 'profil' ? 'text-white' : 'text-gray-400' }}">Profil</span>
                </a>
            </li>

            <!-- Manajemen Magang -->
            <li class="text-xs px-2 text-gray-800 uppercase">Manajemen Magang</li>

            <li>
                <a href="{{ url('/lowongan/mahasiswa/mahasiswa') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'lowongan' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'lowongan' ? 'text-white' : 'text-gray-400 dark:text-white' }}"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 0 0-2 2v4m5-6h8M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m0 0h3a2 2 0 0 1 2 2v4m0 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6m18 0s-4 2-9 2-9-2-9-2m9-2h.01" />
                    </svg>
                    <span class="ml-3 {{ $activemenu == 'lowongan' ? 'text-white' : 'text-gray-400' }}">Lowongan</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/pengajuan/mahasiswa') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'pengajuan' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'pengajuan' ? 'text-white' : 'text-gray-400 dark:text-white' }}"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 3v4a1 1 0 0 1-1 1H5m4 6 2 2 4-4m4-8v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z" />
                    </svg>
                    <span
                        class="ml-3 {{ $activemenu == 'pengajuan' ? 'text-white' : 'text-gray-400' }}">Pengajuan</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/monitoring/mahasiswa') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'monitoring' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'monitoring' ? 'text-white' : 'text-gray-400 dark:text-white' }}" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 19V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v13H7a2 2 0 0 0-2 2Zm0 0a2 2 0 0 0 2 2h12M9 3v14m7 0v4" />
                    </svg>
                    <span
                        class="ml-3 {{ $activemenu == 'monitoring' ? 'text-white' : 'text-gray-400' }}">Monitoring</span>
                </a>
            </li>


            <!-- Logout -->
            <li class="mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        onclick="event.preventDefault(); localStorage.removeItem('auth_token'); this.closest('form').submit();"
                        class="w-full flex items-center p-2 text-red-600 rounded-lg hover:bg-red-200 group cursor-pointer">
                        <svg class="w-6 h-6 text-red-600 dark:text-white" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                        </svg>
                        <span class="ml-3 text-left">Keluar</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
