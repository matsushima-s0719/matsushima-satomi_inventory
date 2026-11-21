<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\StockMovement;

class ItemAndMovementSeeder extends Seeder
{
    public function run(): void
    {
        $itemsData = [
            ['item_code' => 'ITM-001', 'name' => '油性ボールペン 黒 10本入', 'category_id' => 1, 'supplier_id' => 1, 'price' => 880, 'reorder_point' => 10, 'description' => '0.7mm 事務用定番ボールペン'],
            ['item_code' => 'ITM-002', 'name' => 'A4 クリアホルダー 100枚入', 'category_id' => 1, 'supplier_id' => 1, 'price' => 1200, 'reorder_point' => 5, 'description' => '透明度が高いPP製クリアファイル'],
            ['item_code' => 'ITM-003', 'name' => 'スティックのり 5本パック', 'category_id' => 1, 'supplier_id' => 3, 'price' => 550, 'reorder_point' => 8, 'description' => '普通紙・厚紙用'],
            ['item_code' => 'ITM-004', 'name' => '付箋紙 75×75mm 10冊入', 'category_id' => 1, 'supplier_id' => 1, 'price' => 980, 'reorder_point' => 10, 'description' => 'イエロー 100枚×10冊'],

            ['item_code' => 'ITM-005', 'name' => 'A4 コピー用紙 500枚×5冊', 'category_id' => 2, 'supplier_id' => 2, 'price' => 2480, 'reorder_point' => 10, 'description' => '高白色コピー用紙'],
            ['item_code' => 'ITM-006', 'name' => '純正インクカートリッジ ブラック', 'category_id' => 2, 'supplier_id' => 2, 'price' => 3200, 'reorder_point' => 5, 'description' => '大容量タイプ'],
            ['item_code' => 'ITM-007', 'name' => 'USBメモリ 32GB', 'category_id' => 2, 'supplier_id' => 3, 'price' => 1100, 'reorder_point' => 5, 'description' => 'USB3.2対応 キャップ式'],
            ['item_code' => 'ITM-008', 'name' => 'ラミネートフィルム A4 100枚入', 'category_id' => 2, 'supplier_id' => 2, 'price' => 1450, 'reorder_point' => 4, 'description' => '100ミクロン'],

            ['item_code' => 'ITM-009', 'name' => 'ボックスティッシュ 5箱パック', 'category_id' => 3, 'supplier_id' => 1, 'price' => 450, 'reorder_point' => 10, 'description' => '200組（400枚）×5箱'],
            ['item_code' => 'ITM-010', 'name' => 'ペーパータオル 200枚×5個', 'category_id' => 3, 'supplier_id' => 1, 'price' => 780, 'reorder_point' => 8, 'description' => '再生紙100% 中判サイズ'],
            ['item_code' => 'ITM-011', 'name' => '単3アルカリ乾電池 20本入', 'category_id' => 3, 'supplier_id' => 3, 'price' => 1380, 'reorder_point' => 5, 'description' => '長期保存対応'],
            ['item_code' => 'ITM-012', 'name' => '除菌ウェットティッシュ 詰替用', 'category_id' => 3, 'supplier_id' => 1, 'price' => 390, 'reorder_point' => 10, 'description' => 'アルコールタイプ 80枚入'],

            ['item_code' => 'ITM-013', 'name' => '緑茶 500ml 24本入', 'category_id' => 4, 'supplier_id' => 2, 'price' => 2160, 'reorder_point' => 5, 'description' => '来客用ペットボトル緑茶'],
            ['item_code' => 'ITM-014', 'name' => 'ミネラルウォーター 500ml 24本入', 'category_id' => 4, 'supplier_id' => 2, 'price' => 1680, 'reorder_point' => 5, 'description' => '国産天然水'],
            ['item_code' => 'ITM-015', 'name' => 'ドリップコーヒー 50袋入', 'category_id' => 4, 'supplier_id' => 1, 'price' => 1980, 'reorder_point' => 4, 'description' => 'オリジナルブレンド'],
            ['item_code' => 'ITM-016', 'name' => '紙コップ 7オンス 100個入', 'category_id' => 4, 'supplier_id' => 1, 'price' => 350, 'reorder_point' => 6, 'description' => '205ml ホワイト'],

            ['item_code' => 'ITM-017', 'name' => '半透明ゴミ袋 45L 50枚入', 'category_id' => 5, 'supplier_id' => 3, 'price' => 680, 'reorder_point' => 8, 'description' => '厚み0.025mm'],
            ['item_code' => 'ITM-018', 'name' => 'トイレ用中性洗剤 500ml', 'category_id' => 5, 'supplier_id' => 3, 'price' => 280, 'reorder_point' => 5, 'description' => '除菌・消臭効果'],
            ['item_code' => 'ITM-019', 'name' => 'マイクロファイバークロス 10枚入', 'category_id' => 5, 'supplier_id' => 3, 'price' => 850, 'reorder_point' => 5, 'description' => 'デスク・ガラス清掃用'],
            ['item_code' => 'ITM-020', 'name' => 'アルコール除菌スプレー 400ml', 'category_id' => 5, 'supplier_id' => 2, 'price' => 520, 'reorder_point' => 6, 'description' => 'キッチン・テーブル用'],
        ];

        $movementsPlan = [
            1 => [
                ['user_id' => 1, 'type' => 'in',  'quantity' => 20, 'note' => '初回仕入'],
                ['user_id' => 2, 'type' => 'out', 'quantity' => 5,  'note' => '営業部へ配布'],
            ],
            2 => [
                ['user_id' => 1, 'type' => 'in',  'quantity' => 10, 'note' => '初回仕入'],
                ['user_id' => 1, 'type' => 'out', 'quantity' => 7,  'note' => '総務部で使用'],
            ],
            3 => [
                ['user_id' => 2, 'type' => 'in',  'quantity' => 15, 'note' => '初回仕入'],
                ['user_id' => 2, 'type' => 'out', 'quantity' => 15, 'note' => '全社配布のため在庫切れ'],
            ],
            4 => [
                ['user_id' => 1, 'type' => 'in',  'quantity' => 12, 'note' => '初回仕入'],
                ['user_id' => 2, 'type' => 'out', 'quantity' => 10, 'note' => '会議室備品として出庫'],
            ],
            5 => [
                ['user_id' => 1, 'type' => 'in',  'quantity' => 30, 'note' => '定期入荷'],
                ['user_id' => 2, 'type' => 'out', 'quantity' => 12, 'note' => '複合機補充'],
            ],
            6 => [
                ['user_id' => 2, 'type' => 'in',  'quantity' => 8, 'note' => '初回仕入'],
                ['user_id' => 1, 'type' => 'out', 'quantity' => 6, 'note' => 'プリンタインク交換'],
            ],
        ];

        foreach ($itemsData as $index => $data) {
            $itemNumber = $index + 1; 

            $item = Item::create(array_merge($data, ['stock' => 0]));

            $currentStock = 0;

            if (isset($movementsPlan[$itemNumber])) {
                foreach ($movementsPlan[$itemNumber] as $move) {
                    StockMovement::create([
                        'item_id'  => $item->id,
                        'user_id'  => $move['user_id'],
                        'type'     => $move['type'],
                        'quantity' => $move['quantity'],
                        'note'     => $move['note'],
                    ]);

                    if ($move['type'] === 'in') {
                        $currentStock += $move['quantity'];
                    } else {
                        $currentStock -= $move['quantity'];
                    }
                }
            } else {
                $initialQty = 15;
                StockMovement::create([
                    'item_id'  => $item->id,
                    'user_id'  => ($itemNumber % 2 === 0) ? 2 : 1,
                    'type'     => 'in',
                    'quantity' => $initialQty,
                    'note'     => '初回入庫',
                ]);
                $currentStock = $initialQty;
            }

            $item->update(['stock' => $currentStock]);
        }
    }
}