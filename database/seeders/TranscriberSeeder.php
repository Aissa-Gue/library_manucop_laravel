<?php

namespace Database\Seeders;

use App\Models\Transcriber;
use Illuminate\Database\Seeder;

class TranscriberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Transcriber::create([
            'full_name' => 'مجهول'
        ]);
    }
}