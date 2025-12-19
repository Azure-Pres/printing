<?php

use Milon\Barcode\DNS1D;

// if (! function_exists('safe_barcode')) {

//     function safe_barcode(string $value, string $type = 'CODE128', int $width = 2, int $height = 40): string
//     {
//         if (empty($value)) {
//             return '';
//         }

//         // Remove unsupported characters
//         $clean = preg_replace('/[^0-9A-Z]/', '', strtoupper($value));

//         if ($clean === '') {
//             return '';
//         }

//         try {
//             return DNS1D::getBarcodeHTML($clean, $type, $width, $height) ?: '';
//         } catch (\Throwable $e) {
//             logger()->warning('Barcode skipped', [
//                 'value' => $value,
//                 'error' => $e->getMessage()
//             ]);
//             return '';
//         }
//     }
// }
