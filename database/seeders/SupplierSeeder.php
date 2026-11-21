<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Supplier;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            [
                'name' => '株式会社アスクルオフィス',
                'phone' => '03-1111-2222',
                'email' => 'order@askul-office.example.com',
                'address' => '東京都千代田区丸の内1-1-1',
            ],
            [
                'name' => '大塚サプライ株式会社',
                'phone' => '06-3333-4444',
                'email' => 'info@otsuka-supply.example.com',
                'address' => '大阪府大阪市北区梅田2-2-2',
            ],
            [
                'name' => '株式会社サンワ商事',
                'phone' => '052-5555-6666',
                'email' => 'sales@sanwa-shoji.example.com',
                'address' => '愛知県名古屋市中区栄3-3-3',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}