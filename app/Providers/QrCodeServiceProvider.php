<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use RobThree\Auth\Providers\Qr\IQRCodeProvider;
use App\Services\GdQrCodeGenerator;

class QrCodeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(IQRCodeProvider::class, GdQrCodeGenerator::class);
    }

    public function boot(): void {
        //
    }
}
