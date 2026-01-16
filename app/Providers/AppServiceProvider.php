<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\Pengajuan;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.mahasiswa-navigation', function ($view) {
    $user = Auth::user();
    $notifications = [];
    if ($user && $user->role === 'mahasiswa' && $user->mahasiswa) {
        $pengajuans = Pengajuan::with('lowongan.perusahaan')
            ->where('mahasiswa_id', $user->mahasiswa->id)
            ->get();
        foreach ($pengajuans as $pengajuan) {
            $perusahaanNama = optional(optional($pengajuan->lowongan)->perusahaan)->nama;
            if (!$perusahaanNama) {
                continue;
            }
            if ($pengajuan->status == 'accepted') {
                $notifications[] = "Pengajuan magang di {$perusahaanNama} telah <b>DITERIMA</b>.";
            } elseif ($pengajuan->status == 'rejected') {
                $notifications[] = "Pengajuan magang di {$perusahaanNama} <b>DITOLAK</b>.";
            } elseif ($pengajuan->status == 'pending') {
                $notifications[] = "Pengajuan magang di {$perusahaanNama} sedang <b>DIPROSES</b>.";
            }
        }
    }
    $view->with('notifications', $notifications);
});


        // Set default locale for Carbon
        Carbon::setLocale(config('app.locale'));

        // Set the default timezone
        date_default_timezone_set(config('app.timezone'));
    }
}
