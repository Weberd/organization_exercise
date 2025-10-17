<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BuildingSeeder extends Seeder
{
    public function run(): void
    {
        $buildings = [
            [
                'address' => 'г. Москва, ул. Ленина, д. 1',
                'location' => DB::raw('POINT(37.618423, 55.751244)'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'г. Москва, ул. Блюхера, д. 32/1',
                'location' => DB::raw('POINT(37.615560, 55.752220)'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'г. Москва, Тверская ул., д. 15',
                'location' => DB::raw('POINT(37.605591, 55.764931)'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'г. Санкт-Петербург, Невский проспект, д. 28',
                'location' => DB::raw('POINT(30.323640, 59.934280)'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'г. Санкт-Петербург, ул. Марата, д. 86',
                'location' => DB::raw('POINT(30.353640, 59.922860)'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'г. Москва, Кутузовский проспект, д. 24',
                'location' => DB::raw('POINT(37.535570, 55.740940)'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'г. Москва, ул. Арбат, д. 53',
                'location' => DB::raw('POINT(37.588780, 55.749840)'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'address' => 'г. Москва, Садовое кольцо, д. 12',
                'location' => DB::raw('POINT(37.618920, 55.760370)'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('buildings')->insert($buildings);
    }
}
