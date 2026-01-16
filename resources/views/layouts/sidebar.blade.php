<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-full sm:h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800 ">
        <ul class="space-y-2 font-medium ">
            <!-- Dashboard -->
            <li class="mb-4">
                <a href="{{ url('/dashboard') }}"
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

            <!-- Manajemen Data -->
            <li class="text-xs px-2 text-gray-800 uppercase">Manajemen Data</li>

            <li>
                <a href="{{ url('/pengguna') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'pengguna' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'pengguna' ? 'text-white' : 'text-gray-400 dark:text-white' }}"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 12c2.21 0 4-1.79 4-4S14.21 4 12 4 8 5.79 8 8s1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                    </svg>
                    <span class="ml-3 {{ $activemenu == 'pengguna' ? 'text-white' : 'text-gray-400' }}">Pengguna</span>
                </a>
            </li>

            <li class="mb-4">
                <button type="button"
                    class="flex items-center w-full p-2 text-base rounded-lg group {{ $activemenu == 'perusahaan' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}"
                    aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                    <svg class="w-5 h-5 {{ $activemenu == 'perusahaan' ? 'text-white' : 'text-gray-400 dark:text-white' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                    </svg>

                    <span
                        class="flex-1 ms-3  text-left {{ $activemenu == 'perusahaan' ? 'text-white' : 'text-gray-400' }}"
                        rtl:text-right whitespace-nowrap">Perusahaan</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 4 4 4-4" />
                    </svg>
                </button>
                <ul id="dropdown-example" class="hidden py-2 space-y-2">
                    <li>
                        <a href="{{ url('/bidang_perusahaan') }}"
                            class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Bidang
                            Perusahaan</a>
                    </li>
                    <li>
                        <a href="{{ url('/perusahaan') }}"
                            class="flex items-center w-full p-2 text-gray-400 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Daftar
                            Perusahaan</a>
                    </li>
                </ul>
                {{-- <a href="{{ url('/perusahaan') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'perusahaan' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'perusahaan' ? 'text-white' : 'text-gray-400 dark:text-white' }}" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 4h12M6 4v16M6 4H5m13 0v16m0-16h1m-1 16H6m12 0h1M6 20H5M9 7h1v1H9V7Zm5 0h1v1h-1V7Zm-5 4h1v1H9v-1Zm5 0h1v1h-1v-1Zm-3 4h2a1 1 0 0 1 1 1v4h-4v-4a1 1 0 0 1 1-1Z" />
                    </svg>
                    <span class="ml-3 {{ $activemenu == 'perusahaan' ? 'text-white' : 'text-gray-400' }}">Perusahaan</span>
                </a> --}}
            </li>

            <!-- Manajemen Magang -->
            <li class="text-xs px-2 text-gray-800 uppercase">Manajemen Magang</li>

            <li>
                <a href="{{ url('/periode') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'periode' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'periode' ? 'text-white' : 'text-gray-400 dark:text-white' }}"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 10h16m-8-3V4M7 7V4m10 3V4M5 20h14a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1Zm3-7h.01v.01H8V13Zm4 0h.01v.01H12V13Zm4 0h.01v.01H16V13Zm-8 4h.01v.01H8V17Zm4 0h.01v.01H12V17Zm4 0h.01v.01H16V17Z" />
                    </svg>
                    <span class="ml-3 {{ $activemenu == 'periode' ? 'text-white' : 'text-gray-400' }}">Periode</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/programstudi') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'programstudi' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'programstudi' ? 'text-white' : 'text-gray-400 dark:text-white' }}"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3.78552 9.5 12.7855 14l9-4.5-9-4.5-8.99998 4.5Zm0 0V17m3-6v6.2222c0 .3483 2 1.7778 5.99998 1.7778 4 0 6-1.3738 6-1.7778V11" />
                    </svg>
                    <span class="ml-3 {{ $activemenu == 'programstudi' ? 'text-white' : 'text-gray-400' }}">Program
                        Studi</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/jenismagang') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'jenismagang' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'jenismagang' ? 'text-white' : 'text-gray-400 dark:text-white' }} aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.2 6H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11.2a1 1 0 0 0 .747-.334l4.46-5a1 1 0 0 0 0-1.332l-4.46-5A1 1 0 0 0 15.2 6Z" />
                    </svg>

                    <span class="ml-3 {{ $activemenu == 'jenismagang' ? 'text-white' : 'text-gray-400' }}">Jenis
                        Magang</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/skill') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'skill' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'skill' ? 'text-white' : 'text-gray-400 dark:text-white' }}"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 9a3 3 0 0 1 3-3m-2 15h4m0-3c0-4.1 4-4.9 4-9A6 6 0 1 0 6 9c0 4 4 5 4 9h4Z" />
                    </svg>

                    <span class="ml-3 {{ $activemenu == 'skill' ? 'text-white' : 'text-gray-400' }}">Skill</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/lowongan') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'lowongan' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'lowongan' ? 'text-white' : 'text-gray-400 dark:text-white' }}"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 0 0-2 2v4m5-6h8M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m0 0h3a2 2 0 0 1 2 2v4m0 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6m18 0s-4 2-9 2-9-2-9-2m9-2h.01" />
                    </svg>
                    <span
                        class="ml-3 {{ $activemenu == 'lowongan' ? 'text-white' : 'text-gray-400' }}">Lowongan</span>
                </a>
            </li>
            {{-- <li>
                <a href="{{ url('/bidang_perusahaan') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'bidang_perusahaan' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'bidang_perusahaan' ? 'text-white' : 'text-gray-400 dark:text-white' }}" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 0 0-2 2v4m5-6h8M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2m0 0h3a2 2 0 0 1 2 2v4m0 0v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-6m18 0s-4 2-9 2-9-2-9-2m9-2h.01" />
                    </svg>
                    <span class="ml-3 {{ $activemenu == 'bidang_perusahaan' ? 'text-white' : 'text-gray-400' }}">Bidang Perusahaan</span>
                </a>
            </li> --}}

            <li>
                <a href="{{ url('/pengajuan') }}"
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
                <a href="{{ url('/statistik') }}"
                    class="flex items-center p-2 rounded-lg group {{ $activemenu == 'statistik' ? 'text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <svg class="w-5 h-5 {{ $activemenu == 'statistik' ? 'text-white' : 'text-gray-400 dark:text-white' }}"
                        fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 6.025A7.5 7.5 0 1 0 17.975 14H10V6.025Z" />
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13.5 3c-.169 0-.334.014-.5.025V11h7.975c.011-.166.025-.331.025-.5A7.5 7.5 0 0 0 13.5 3Z" />
                    </svg>
                    <span
                        class="ml-3 {{ $activemenu == 'statistik' ? 'text-white' : 'text-gray-400' }}">Statistik</span>
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M20 12H8m12 0-4 4m4-4-4-4M9 4H7a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h2" />
                        </svg>
                        <span class="ml-3 text-left">Keluar</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
