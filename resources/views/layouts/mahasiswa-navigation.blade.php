<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar"
                    type="button"
                    class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd"
                            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
                        </path>
                    </svg>
                </button>
                <a href="" class="flex ms-2 md:me-24">
                    <img src="{{ asset('images/Logo-Sigmagang.png') }}" class="h-8 me-3" alt="FlowBite Logo" />
                    <span
                        class="self-center text-[18px] font-semibold sm:text-[20px] whitespace-nowrap text-orange-500">SIGMAGANG</span>
                </a>
            </div>
            <div class="flex items-center">
                <div class="flex items-center ms-3">
                    <div class="flex items-center gap-4">
                        <button id="notifBtn" type="button" aria-haspopup="true" aria-expanded="false"
                            class="relative flex items-center text-gray-800 dark:text-white focus:outline-none">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-5-5.917V4a1 1 0 10-2 0v1.083A6 6 0 006 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0a3 3 0 11-6 0h6z">
                                </path>
                            </svg>
                            <span
                                class="absolute top-0 right-0 block h-2 w-2 rounded-full ring-2 ring-white bg-red-500"></span>
                        </button>

                        <div class="flex flex-col items-end">
                            <span class="text-mirage-950 font-medium">{{ Auth::user()->name }}</span>
                            <span class="text-sm text-gray-500">{{ str_replace('_', ' ', Auth::user()->role) }}</span>
                        </div>

                        <button type="button"
                            class="flex items-center text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                            aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <span class="sr-only">Open user menu</span>
                            @if (Auth::user()->foto)
                                <img class="w-10 h-10 rounded-full" src="{{ asset('storage/' . Auth::user()->foto) }}"
                                    alt="user photo">
                            @else
                                <img src="{{ asset('images/Profile.jpg') }}" alt="Foto Default"
                                    class="w-10 h-10 rounded-full object-cover border border-gray-300">
                            @endif
                        </button>

                    </div>

                    <div id="notifModal"
                        class="hidden fixed top-[68px] right-6 z-50 w-80 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-md shadow-lg p-4">
                        <h3 class="text-lg font-semibold mb-2 text-gray-900 dark:text-white">Notifikasi</h3>
                       <ul class="max-h-48 overflow-y-auto divide-y divide-gray-200 dark:divide-gray-700">
    @forelse($notifications ?? [] as $notif)
        <li class="py-2 text-gray-700 dark:text-gray-300">{!! $notif !!}</li>
    @empty
        <li class="py-2 text-gray-700 dark:text-gray-300">Tidak ada notifikasi.</li>
    @endforelse
</ul>
                        <button id="notifCloseBtn"
                            class="mt-3 w-full bg-blue-600 text-white rounded-md py-1 hover:bg-blue-800">Tutup</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    const notifBtn = document.getElementById('notifBtn');
    const notifModal = document.getElementById('notifModal');
    const notifCloseBtn = document.getElementById('notifCloseBtn');

    notifBtn.addEventListener('click', () => {
        notifModal.classList.toggle('hidden');
    });

    notifCloseBtn.addEventListener('click', () => {
        notifModal.classList.add('hidden');
    });

    window.addEventListener('click', (e) => {
        if (!notifModal.contains(e.target) && !notifBtn.contains(e.target)) {
            notifModal.classList.add('hidden');
        }
    });
</script>
