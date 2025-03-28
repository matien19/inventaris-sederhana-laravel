<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\TransaksiDetailModel;
use App\Models\TransaksiModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksi = TransaksiModel::all();
        return view('layout.pages.transaksi.transaksi' , compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detail($id)
    {
        $transaksi = TransaksiDetailModel::with('produk')->get();
        // Log::info('Transaksi Detail :'. $transaksi);
        if (!$transaksi) {
            return redirect()->back()->with('error', 'Transaksi not found');
        }

        return view('layout.pages.transaksi.transaksiDetail', compact('id', 'transaksi') );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function detail_store(string $id, string $produk_id)
    {
        $produk = Product::firstWhere('sku', $produk_id);

        log::info('Produk :'. $produk);
        if (!$produk) {
            return redirect()->back()->with('error', 'Product not found');
        }

        $transaksi_baru = TransaksiDetailModel::create([
            'no_transaksi' => $id,
            'produk_id' => $produk->id,
            'harga' => $produk->price,
            'jumlah' => 1,
        ]);
    
        if (!$transaksi_baru) {
            return response()->json([
                'message' => 'Failed to add product to transaction',
            ], 500);
        }
    
        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'data' => $transaksi_baru->load('produk') // Memuat relasi produk agar respons lengkap
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
