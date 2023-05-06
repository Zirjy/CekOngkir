<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileCity = file_get_contents(base_path('/database/city.json'));
        $fileRegency = file_get_contents(base_path('/database/regency.json'));

        $datacity = json_decode($fileCity, true);
        $dataRegency = json_decode($fileRegency, true);

        City::insert($datacity);
        City::insert($dataRegency);
    }
}