<?php

namespace Database\Seeders;

use App\Models\Manutype;
use Illuminate\Database\Seeder;

class ManutypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manutypes = [
            [
                'name' => 'تصحيح',
            ],
            [
                'name' => 'تصويب',
            ],
            [
                'name' => 'مقابلة',
            ],
            [
                'name' => 'تعليق',
            ]
        ];

        foreach($manutypes as $manutype){
            Manutype::create($manutype);
        }
    }
}
