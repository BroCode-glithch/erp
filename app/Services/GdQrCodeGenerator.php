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
        // Return the MIME type for the QR code image
        return 'image/png';
    }

    public function getQRCodeImage(string $text, int $size = 200): string
    {
        // Create a new renderer with the specified size
        $renderer = new ImageRenderer(
            new RendererStyle($size),
            new SvgImageBackEnd()
        );

        // Create a writer instance with the renderer
        // and generate the QR code image as a string
        $writer = new Writer($renderer);
        return $writer->writeString($text);
    }
}
