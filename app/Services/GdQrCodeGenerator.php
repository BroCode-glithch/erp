<?php

// app/Services/GdQrCodeGenerator.php
namespace App\Services;

use RobThree\Auth\Providers\Qr\IQRCodeProvider;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Writer;

class GdQrCodeGenerator implements IQRCodeProvider
{
    public function getMimeType(): string
    {
        return 'image/png';
    }

    public function getQRCodeImage(string $text, int $size = 200): string
    {
        $renderer = new ImageRenderer(
            new RendererStyle($size),
            new SvgImageBackEnd()
        );

        $writer = new Writer($renderer);
        return $writer->writeString($text);
    }
}
