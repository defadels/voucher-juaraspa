<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QrCodeService
{
    /**
     * Generate SVG QR Code asli dan simpan ke storage.
     */
    public function generate(string $kodeVoucher): string
    {
        $path = 'qrcodes/'.$kodeVoucher.'.svg';

        if (! Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory('qrcodes');

            // Menghasilkan QR Code SVG asli menggunakan SimpleSoftwareIO
            // Size di set ke 300px agar mudah di-scan oleh kamera
            $svgContent = QrCode::format('svg')
                ->size(300)
                ->margin(2)
                ->generate($kodeVoucher);
            
            Storage::disk('public')->put($path, $svgContent);
        }

        return $path;
    }

    /**
     * Dapatkan URL publik QR Code.
     */
    public function getPublicUrl(string $storagePath): string
    {
        return Storage::url($storagePath);
    }
}
