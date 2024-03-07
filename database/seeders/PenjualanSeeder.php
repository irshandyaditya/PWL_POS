<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'penjualan_id' => 1,
                'user_id' => 3,
                'pembeli' => 'Rendy',
                'penjualan_kode' => 'AAA001',
                'penjualan_tanggal' => '2024-03-07 11:30:00',
            ],
            [
                'penjualan_id' => 2,
                'user_id' => 3,
                'pembeli' => 'Muza',
                'penjualan_kode' => 'AAA002',
                'penjualan_tanggal' => '2024-03-07 12:31:00',
            ],
            [
                'penjualan_id' => 3,
                'user_id' => 3,
                'pembeli' => 'Sony',
                'penjualan_kode' => 'AAA003',
                'penjualan_tanggal' => '2024-03-07 12:53:05',
            ],
            [
                'penjualan_id' => 4,
                'user_id' => 3,
                'pembeli' => 'Rafsan',
                'penjualan_kode' => 'AAA004',
                'penjualan_tanggal' => '2024-03-07 13:15:00',
            ],
            [
                'penjualan_id' => 5,
                'user_id' => 3,
                'pembeli' => 'Gaco',
                'penjualan_kode' => 'AAA005',
                'penjualan_tanggal' => '2024-03-07 14:00:01',
            ],
            [
                'penjualan_id' => 6,
                'user_id' => 3,
                'pembeli' => 'Migu',
                'penjualan_kode' => 'AAA006',
                'penjualan_tanggal' => '2024-03-07 14:33:43',
            ],
            [
                'penjualan_id' => 7,
                'user_id' => 3,
                'pembeli' => 'Putra',
                'penjualan_kode' => 'AAA007',
                'penjualan_tanggal' => '2024-03-07 15:10:20',
            ],
            [
                'penjualan_id' => 8,
                'user_id' => 3,
                'pembeli' => 'Rochmen',
                'penjualan_kode' => 'AAA008',
                'penjualan_tanggal' => '2024-03-07 16:01:53',
            ],
            [
                'penjualan_id' => 9,
                'user_id' => 3,
                'pembeli' => 'Arya',
                'penjualan_kode' => 'AAA009',
                'penjualan_tanggal' => '2024-03-07 16:34:54',
            ],
            [
                'penjualan_id' => 10,
                'user_id' => 3,
                'pembeli' => 'Rizky',
                'penjualan_kode' => 'AAA010',
                'penjualan_tanggal' => '2024-03-07 17:19:56',
            ],
        ];
        DB::table('t_penjualan')->insert($data);
    }
}
