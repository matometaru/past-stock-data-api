<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        //削除
        Category::truncate();

        $categories = [
            1 => '水産・農林',
            2 => '鉱業',
            3 => '建設業',
            4 => '食料品',
            5 => '繊維製品',
            6 => 'パルプ・紙',
            7 => '化学',
            8 => '医薬品',
            9 => '石油・石炭',
            10 => 'ゴム',
            11 => 'ガラス・土石',
            12 => '鉄鋼',
            13 => '非鉄金属',
            14 => '金属製品',
            15 => '機械',
            16 => '電気機器',
            17 => '輸送用機器',
            18 => '精密機器',
            19 => 'その他製品',
            20 => '電気・ガス',
            21 => '陸運',
            22 => '海運',
            23 => '空運',
            24 => '倉庫・運輸',
            25 => '情報・通信',
            26 => '卸売',
            27 => '小売',
            28 => '銀行',
            29 => '証券・商先',
            30 => '保険',
            31 => 'その他金融',
            32 => '不動産',
            33 => 'サービス'
        ];

        foreach ($categories as $key => $value) {
            $param = [
                'name' => $value,
            ];
            DB::table('categories')->insert($param);
        }

    }
}
