<?php

namespace Database\Seeders;

use App\Models\loketModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lokets = ['Loket 1', 'Loket 2', 'Loket 3'];

        foreach ($lokets as $nama) {
            loketModel::firstOrCreate(['nama' => $nama]);
        }
    }
}
