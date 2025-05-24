<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGMAGANG - Login</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/Logo-Sigmagang.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white">
    <!-- Konten -->
    <div class="w-full min-h-screen bg-white flex flex-col lg:flex-row px-4 sm:px-8 lg:px-12 ">
        <!-- Kiri: Form Login -->
        <div class="w-full lg:w-1/2 min-h-screen flex items-center justify-center bg-gray-50 px-4 sm:px-8 mt-8 mb-8 ">
            <div class="w-full max-w-md bg-white p-8 rounded-lg border border-gray-200 shadow-md">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-mirage-950 mb-1">Daftar Akun</h2>
                    <p class="text-sm text-gray-500">Lengkapi data untuk mulai mendaftar magang.</p>
                </div>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Username -->
                    <div class="mb-4">
                        <label for="name"
                            class="block text-[14px] font-semibold text-mirage-950 mb-1">Username</label>
                        <input id="name" name="name" type="text" placeholder="Masukkan username"
                            class="form-input block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            value="{{ old('name') }}" required autofocus autocomplete="name" />
                        @error('name')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-[14px] font-semibold text-mirage-950 mb-1">Email</label>
                        <input id="email" name="email" type="email" placeholder="Masukkan email"
                            class="form-input block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"
                            value="{{ old('email') }}" required autocomplete="username" />
                        @error('email')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-[14px] font-semibold text-mirage-950 mb-1">Kata
                            sandi</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" placeholder="Masukkan kata sandi"
                                class="form-input block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none pr-4"
                                required autocomplete="new-password" />
                        </div>
                        @error('password')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-6">
                        <label for="password_confirmation"
                            class="block text-[14px] font-semibold text-mirage-950 mb-1">Konfirmasi kata sandi</label>
                        <div class="relative">
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                placeholder="Ulangi kata sandi"
                                class="form-input block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none pr-4"
                                required autocomplete="new-password" />
                        </div>
                        @error('password_confirmation')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol -->
                    <div class="space-y-3">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md text-sm font-semibold transition duration-200">
                            Daftar
                        </button>

                        <a href="{{ route('login') }}"
                            class="w-full inline-block text-center text-blue-600 border border-blue-500 py-2 px-4 rounded-md hover:bg-blue-50 transition duration-200 text-sm font-semibold">
                            Sudah punya akun? Masuk
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Kanan: Logo Perusahaan -->
        <div class="w-full lg:w-1/2 h-[500px] lg:h-screen grid grid-cols-2 sm:grid-cols-3 gap-4 overflow-hidden mt-8 lg:mt-0">
            @for ($i = 0; $i < 3; $i++)
                <div class="h-full overflow-hidden flex flex-col items-center justify-center">
                    <div class="{{ $i % 2 === 0 ? 'scroll-up' : 'scroll-down' }} flex flex-col items-center space-y-6">
                        @foreach (array_merge($logos = ['mandiri', 'bni', 'btn', 'bri', 'telkom', 'krakatau', 'bappenas', 'inka', 'perumnas', 'kai', 'pln', 'pertamina'], $logos) as $logo)
                            <div class="py-2">
                                <img src="{{ asset('logo/' . $logo . '.png') }}" alt="{{ $logo }}"
                                    class="h-24 w-auto object-contain" />
                            </div>
                        @endforeach
                    </div>
                </div>
            @endfor
        </div>

    </div>
</body>

</html>
