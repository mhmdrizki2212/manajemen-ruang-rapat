<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FasilitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('fasilitas')->insert([
            ['nama' => 'Proyektor'],
            ['nama' => 'Papan Tulis'],
            ['nama' => 'Sound System'],
            ['nama' => 'Meja Rapat'],
            ['nama' => 'Kamera'],
            ['nama' => 'Microphone'],
        ]);
    }
}
