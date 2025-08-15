<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gedung;

class GedungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gedung::create([
            'nama' => 'Pertamina Hulu Rokan Kantor Zona 1 Jambi',
            'lokasi' => 'Kenali Asam Atas Jambi',
            
        ]);

        Gedung::create([
            'nama' => 'Pertamina EP Field Jambi',
            'lokasi' => 'Kenali Asam Atas Jambi',

        ]);
    }
}
