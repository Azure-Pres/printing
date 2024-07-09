<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use App\Models\Photo;

class TestController extends Controller
{
    public function savePhoto($pdfKey, $photoQrKey)
    {

        $url = "https://business-api.phonepe.com/apis/gemini/v1/external/qrDownload/{$pdfKey}?fileType=pdf";

        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJhenVyZSIsImlhdCI6MTY4MTgxOTI5MiwiaXNzIjoiZ2VtaW5pIiwicm9sZSI6InFyVmVuZG9yIiwidHlwZSI6InN0YXRpYyIsImV4cCI6MzMyMTc4MTkyOTJ9.-XQJ7gbxrowy8i-14SFE2HmmSmhD0oL-cwyLp36O1q4oTQdKWN_M89b6uh5ZNNW9mCDtEm_vuklLDncmL2nKWA";

        $qr_id = "Q808585011@ybl";

        $response = Http::withToken($token)->get($url);

        if ($response->successful()) {
            $photoContent = $response->body();

            $fileName = 'qr_photo_' . $qr_id . '.pdf';

            Storage::disk('public')->put('qr_photos/' . $fileName, $photoContent);

            $photo = new Photo();
            $photo->photo_qr_key = $photoQrKey;
            $photo->photo_path = 'qr_photos/' . $fileName;
            $photo->qr_id = $qr_id;
            $photo->save();

            return response()->json(['message' => 'Photo saved successfully.'], 200);
        } else {
            return response()->json(['message' => 'Failed to download the photo.'], 500);
        }
    }
}