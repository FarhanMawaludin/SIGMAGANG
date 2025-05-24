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
        <div class="w-full lg:w-1/2 min-h-screen flex items-center justify-center bg-gray-50 px-4 sm:px-8  ">
            <div class="w-full max-w-md bg-white p-8 rounded-lg border border-gray-200 shadow-md">
                <div class="text-center mb-6">
                    <h2 class="text-2xl font-bold text-mirage-950 mb-1">Masuk</h2>
                    <p class="text-sm  text-gray-500">
                        Jangan tunggu nanti, daftar magang sekarang dan tunjukkan potensimu di perusahaan besar!
                    </p>
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block text-[14px] font-semibold text-mirage-950 mb-1">Email</label>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required
                            autofocus
                            class="form-input block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        @error('email')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-[14px] font-semibold text-mirage-950 mb-1">Kata
                            sandi</label>
                        <div class="relative">
                            <input type="password" name="password" id="password" required
                                class="form-input block w-full px-4 py-2 text-gray-900 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none pr-4">
                        </div>
                        @error('password')
                            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Ingat Saya & Lupa Password -->
                    <div class="flex items-center justify-between mt-4 mb-6">
                        <label for="remember_me" class="flex items-center">
                            <input id="remember_me" type="checkbox" name="remember"
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                            <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">
                                Lupa password
                            </a>
                        @endif
                    </div>

                    <!-- Tombol -->
                    <div class="space-y-3">
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md text-sm font-semibold transition duration-200">
                            Masuk
                        </button>

                        <a href="{{ route('register') }}"
                            class="w-full inline-block text-center text-blue-600 border border-blue-500 py-2 px-4 rounded-md hover:bg-blue-50 transition duration-200 text-sm font-semibold">
                            Daftar
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
