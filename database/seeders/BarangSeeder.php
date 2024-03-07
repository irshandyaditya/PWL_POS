<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'barang_id' => 1,
                'kategori_id' => 1,
                'barang_kode' => 'AA01',
                'barang_nama' => 'Kentang Goreng Shoestring Aviko 2.5kg Import',
                'harga_beli' => 50000,
                'harga_jual' => 60000,
            ],
            [
                'barang_id' => 2,
                'kategori_id' => 1,
                'barang_kode' => 'AA02',
                'barang_nama' => 'Milo Bubuk 1kg',
                'harga_beli' => 25000,
                'harga_jual' => 30000,
            ],
            [
                'barang_id' => 3,
                'kategori_id' => 2,
                'barang_kode' => 'BB01',
                'barang_nama' => 'SSD EYOTA 512GB SATA III',
                'harga_beli' => 450000,
                'harga_jual' => 500000,
            ],
            [
                'barang_id' => 4,
                'kategori_id' => 2,
                'barang_kode' => 'BB02',
                'barang_nama' => 'UPERFECT Portable Monitor 15.6 Inch 1080P',
                'harga_beli' => 1100000,
                'harga_jual' => 1300000,
            ],
            [
                'barang_id' => 5,
                'kategori_id' => 3,
                'barang_kode' => 'CC01',
                'barang_nama' => 'Poco X6 Pro 5G',
                'harga_beli' => 4700000,
                'harga_jual' => 5000000,
            ],
            [
                'barang_id' => 6,
                'kategori_id' => 3,
                'barang_kode' => 'CC02',
                'barang_nama' => 'Xiaomi Pad 6 8/256',
                'harga_beli' => 4800000,
                'harga_jual' => 5100000,
            ],
            [
                'barang_id' => 7,
                'kategori_id' => 4,
                'barang_kode' => 'DD01',
                'barang_nama' => 'Filosofi Teras',
                'harga_beli' => 90000,
                'harga_jual' => 100000,
            ],
            [
                'barang_id' => 8,
                'kategori_id' => 4,
                'barang_kode' => 'DD02',
                'barang_nama' => 'Atomic Habits',
                'harga_beli' => 50000,
                'harga_jual' => 67000,
            ],
            [
                'barang_id' => 9,
                'kategori_id' => 5,
                'barang_kode' => 'EE01',
                'barang_nama' => 'PS3 Slim Sony Void CFW 1TB',
                'harga_beli' => 1800000,
                'harga_jual' => 2100000,
            ],
            [
                'barang_id' => 10,
                'kategori_id' => 5,
                'barang_kode' => 'EE02',
                'barang_nama' => 'Android Smart TV Box 16/256',
                'harga_beli' => 160000,
                'harga_jual' => 180000,
            ],
        ];
        DB::table('m_barang')->insert($data);
    }
}
