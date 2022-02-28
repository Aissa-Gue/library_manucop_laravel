<?php

namespace Database\Seeders;

use App\Models\Motif;
use Illuminate\Database\Seeder;

class MotifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motifs = [
            [
                'name' => 'دائرة منقطة',
            ],
            [
                'name' => 'فواصل',
            ],
            [
                'name' => 'وريدات',
            ],
            [
                'name' => 'مراوح',
            ],
            [
                'name' => 'براعم',
            ],
            [
                'name' => 'فصوص',
            ]
        ];

        foreach($motifs as $motif){
            Motif::create($motif);
        }
    }
}
