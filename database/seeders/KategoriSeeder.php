<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'kategori_kode' => 'KAT01', 'kategori_nama' => 'Makanan'],
            ['kategori_id' => 2, 'kategori_kode' => 'KAT02', 'kategori_nama' => 'Minuman'],
            ['kategori_id' => 3, 'kategori_kode' => 'KAT03', 'kategori_nama' => 'Peralatan Rumah Tangga'],
            ['kategori_id' => 4, 'kategori_kode' => 'KAT04', 'kategori_nama' => 'Pakaian'],
            ['kategori_id' => 5, 'kategori_kode' => 'KAT05', 'kategori_nama' => 'Elektronik'],
        ];
    }
}
