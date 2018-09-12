<?php

use Illuminate\Database\Seeder;
use App\Market;

class MarketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        //削除
        Market::truncate();

        $categories = [
            1 => '東証1部',
            2 => '東証2部',
            3 => 'マザーズ',
            4 => 'JASDAQスタンダード',
            5 => 'JASDAQグロース',
            6 => '名証1部',
            7 => '名証2部',
            8 => '名証セントレックス',
            9 => '札証',
            10 => '福証'
        ];

        foreach ($categories as $key => $value) {
            $param = [
                'name' => $value,
            ];
            DB::table('categories')->insert($param);
        }

    }
}
