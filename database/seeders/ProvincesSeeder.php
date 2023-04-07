<?php

namespace Database\Seeders;

use App\Models\Provinces;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvincesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = file_get_contents(base_path('/database/provinsi.json'));
        $data = json_decode($file, true);

        Provinces::insert($data);
    }
}
