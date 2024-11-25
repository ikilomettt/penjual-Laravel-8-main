<?php

namespace App\Http\Controllers\API;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function getData(Request $request){
        $request->validate([
            'awal' => 'required|date',
            'akhir' => 'required|date|after_or_equal:awal',
        ]);

        $penjualan = Penjualan::whereBetween('created_at', [
            $request->awal,
            $request->akhir
        ])->get();

        return response()->json([
            "status" => true,
            "message" => "Success",
            "data" => $penjualan
        ]);
    }
}
