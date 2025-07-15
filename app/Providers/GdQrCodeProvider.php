<?php

namespace App\Providers;

// use App\Providers\QrCodeSeProvider;
use Illuminate\Support\ServiceProvider;
use App\Providers\QrCodeServiceProvider;
use RobThree\Auth\Providers\Qr\IQRCodeProvider;

class GdQrCodeProvider extends ServiceProvider
{
    public function register(): void
    {
        // Bind the IQRCodeProvider interface to the QrCodeServiceProvider implementation
        $this->app->bind(IQRCodeProvider::class, QrCodeServiceProvider::class);
    }

    public function boot(): void
    {
        // Optional boot logic
    }
}
