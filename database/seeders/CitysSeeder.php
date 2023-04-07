<?php

namespace Database\Seeders;

use App\Models\Citys;
use App\Models\Provinces;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitysSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileKota = file_get_contents(base_path('/database/kota.json'));
        $fileKabupaten = file_get_contents(base_path('/database/kabupaten.json'));
        
        $dataKota = json_decode($fileKota, true);
        $dataKabupaten = json_decode($fileKabupaten, true);

        Citys::insert($dataKota);
        Citys::insert($dataKabupaten);

    }
}
