<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaytmMerchantKit;
use App\Models\PrintedLabel;
use Illuminate\Support\Facades\DB;

class PaytmMerchantDataController extends Controller
{
    public function getLabelDataByUpi(Request $request)
    {
        // Retrieve the UPI string from the request body
        $upi_qr_url = $request->input('upi_qr_url');

        // Log the UPI string for debugging
        \Log::info("Received UPI QR URL: " . $upi_qr_url);

        // Check if the UPI string is provided
        if (!$upi_qr_url) {
            \Log::error("UPI QR URL not provided in the request.");
            return response()->json(['error' => 'UPI QR URL is required'], 400);
        }

        // Use a database transaction to ensure atomicity
        return DB::transaction(function () use ($upi_qr_url) {
            // Check if this UPI string has already been printed
            $printedLabel = PrintedLabel::where('upi_qr_url', $upi_qr_url)->first();
            
            if ($printedLabel) {
                \Log::warning("Label with UPI string: " . $upi_qr_url . " has already been printed.");
                return response()->json(['error' => 'This label has already been printed'], 409);
            }

            // Query the database for the provided UPI string
            $data = PaytmMerchantKit::where('upi_qr_url', $upi_qr_url)->first();

            // Handle case where data is not found
            if (!$data) {
                \Log::warning("Data not found for UPI string: " . $upi_qr_url);
                return response()->json(['error' => 'Data not found'], 404);
            }

            // Log this print in the printed_labels table
            PrintedLabel::create([
                'upi_qr_url' => $upi_qr_url
            ]);

            // Return the data as a JSON response
            return response()->json($data);
        });
    }
}
