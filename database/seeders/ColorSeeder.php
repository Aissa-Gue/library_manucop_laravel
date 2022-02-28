<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $colors = [
            [
                'name' => 'البني',
            ],
            [
                'name' => 'الأسود',
            ],
            [
                'name' => 'الأحمر',
            ],
            [
                'name' => 'الآجوري',
            ],
            [
                'name' => 'البنفسجي',
            ],
            [
                'name' => 'الوردي',
            ],
            [
                'name' => 'البرتقالي',
            ],
            [
                'name' => 'الأصفر',
            ],
            [
                'name' => 'الأخضر',
            ],
            [
                'name' => 'الأزرق',
            ],
            [
                'name' => 'المذهب',
            ]
        ];

        foreach($colors as $color){
            Color::create($color);
        }
    }
}
