<?php

namespace Database\Seeders;

use App\Models\Couriers;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CouriersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Couriers::insert([
            [
                'code' => 'jne',
                'title' => 'Jalur Nugraha Ekakulir (jne)',
            ],
            [
                'code' => 'pos',
                'title' => 'Post Indonesia',
            ],
            [
                'code' => 'tiki',
                'title' => 'Citra Van Tititpan Kilat'
            ]
        ]);
    }
}
