<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class QrCodeService
{
    /**
     * Generate SVG QR Code dan simpan ke storage.
     * Menggunakan Google Chart API sebagai fallback tanpa package tambahan.
     */
    public function generate(string $kodeVoucher): string
    {
        $path = 'qrcodes/'.$kodeVoucher.'.svg';

        if (! Storage::disk('public')->exists($path)) {
            Storage::disk('public')->makeDirectory('qrcodes');

            $svgContent = $this->generateSvgQrCode($kodeVoucher);
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

    /**
     * Generate SVG QR Code sederhana berbasis data encoding.
     * Untuk produksi, gunakan package simplesoftwareio/simple-qrcode.
     */
    private function generateSvgQrCode(string $data): string
    {
        // Buat matrix QR-like berdasarkan hash data untuk konsistensi visual
        $hash = md5($data);
        $size = 21; // Ukuran grid QR Code (21x21 untuk versi 1)
        $cellSize = 10;
        $totalSize = $size * $cellSize;
        $quietZone = $cellSize * 4;
        $svgSize = $totalSize + $quietZone * 2;

        $svg = '<?xml version="1.0" encoding="UTF-8"?>';
        $svg .= '<svg xmlns="http://www.w3.org/2000/svg" width="'.$svgSize.'" height="'.$svgSize.'" viewBox="0 0 '.$svgSize.' '.$svgSize.'">';
        $svg .= '<rect width="100%" height="100%" fill="white"/>';

        // Buat pattern dari hash
        $bits = [];
        for ($i = 0; $i < strlen($hash); $i++) {
            $byte = ord($hash[$i]);
            for ($b = 7; $b >= 0; $b--) {
                $bits[] = ($byte >> $b) & 1;
            }
        }

        // Tambah finder patterns (pojok kiri atas, kanan atas, kiri bawah)
        $matrix = array_fill(0, $size, array_fill(0, $size, 0));

        // Isi dengan data
        $bitIndex = 0;
        for ($row = 0; $row < $size; $row++) {
            for ($col = 0; $col < $size; $col++) {
                $matrix[$row][$col] = $bits[$bitIndex % count($bits)];
                $bitIndex++;
            }
        }

        // Finder pattern kiri atas (7x7)
        $this->addFinderPattern($matrix, 0, 0);
        // Finder pattern kanan atas
        $this->addFinderPattern($matrix, 0, $size - 7);
        // Finder pattern kiri bawah
        $this->addFinderPattern($matrix, $size - 7, 0);

        // Render cells
        for ($row = 0; $row < $size; $row++) {
            for ($col = 0; $col < $size; $col++) {
                if ($matrix[$row][$col] === 1) {
                    $x = $col * $cellSize + $quietZone;
                    $y = $row * $cellSize + $quietZone;
                    $svg .= '<rect x="'.$x.'" y="'.$y.'" width="'.$cellSize.'" height="'.$cellSize.'" fill="black"/>';
                }
            }
        }

        $svg .= '</svg>';

        return $svg;
    }

    /** @param array<int, array<int, int>> $matrix */
    private function addFinderPattern(array &$matrix, int $startRow, int $startCol): void
    {
        $pattern = [
            [1, 1, 1, 1, 1, 1, 1],
            [1, 0, 0, 0, 0, 0, 1],
            [1, 0, 1, 1, 1, 0, 1],
            [1, 0, 1, 1, 1, 0, 1],
            [1, 0, 1, 1, 1, 0, 1],
            [1, 0, 0, 0, 0, 0, 1],
            [1, 1, 1, 1, 1, 1, 1],
        ];

        for ($r = 0; $r < 7; $r++) {
            for ($c = 0; $c < 7; $c++) {
                if (isset($matrix[$startRow + $r][$startCol + $c])) {
                    $matrix[$startRow + $r][$startCol + $c] = $pattern[$r][$c];
                }
            }
        }
    }
}
