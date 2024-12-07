<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function scan(Request $request)
    {
        $data = $request->input('data');
        if ($data == 'ary sitepu ganteng') {
            dd("data sesuai");
        }

        // dd($data);
        return response()->json(['success' => true, 'data' => $data]);
    }
}
