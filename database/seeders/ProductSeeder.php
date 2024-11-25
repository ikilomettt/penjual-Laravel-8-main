<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Produk::create([
            'id_kategori' => 2,
            'kode_produk' => 'P001',
            'nama_produk' => 'Genteng 2',
            'harga' => 10000,
            'stok' => 10,
        ]);

        Produk::create([
            'id_kategori' => 1,
            'kode_produk' => 'P002',
            'nama_produk' => 'Genteng 1',
            'harga' => 15000,
            'stok' => 10,
        ]);
    }
}
