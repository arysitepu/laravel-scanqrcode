<?php

namespace App\Http\Controllers;

use App\QrCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class QRCodeController extends Controller
{

    public function index()
    {
        $products = QrCode::get();
        $data = [
            'products' => $products
        ];
        return view('welcome', $data);
    }

    public function create()
    {
        return view('create');
    }

    public function save(Request $request)
    {
        $product = $request->input('product');
        $price = $request->input('price');
        $location = $request->input('location');
        $status = false;
        $data = [
            'product' => $product,
            'price' => $price,
            'location' => $location,
            'status' => $status,
        ];
        $newqrcode = QrCode::create($data);
        $lastinsertID = $newqrcode->id;
        $tanggal = now()->format('dmy');
        $merge = $lastinsertID . $tanggal;
        $qrcode = Crypt::encryptString($merge);
        $newqrcode->update([
            'qrcode' => $qrcode
        ]);
        return redirect()->back()->with('success', 'data has been created');
    }

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
