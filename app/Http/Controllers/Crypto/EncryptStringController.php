<?php

namespace App\Http\Controllers\Crypto;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;

class EncryptStringController extends Controller {
    public function __invoke (Request $request, string $string)
    {
        return response()->json([
            Crypt::encryptString($string)
        ]);
    }
}
