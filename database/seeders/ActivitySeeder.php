<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        // Уровень 1
        $food = Activity::create([
            'name' => 'Еда',
            'level' => 1,
        ]);

        $cars = Activity::create([
            'name' => 'Автомобили',
            'level' => 1,
        ]);

        // Уровень 2 - Еда
        $meat = Activity::create([
            'name' => 'Мясная продукция',
            'parent_id' => $food->id,
            'level' => 2,
        ]);

        $dairy = Activity::create([
            'name' => 'Молочная продукция',
            'parent_id' => $food->id,
            'level' => 2,
        ]);

        $bakery = Activity::create([
            'name' => 'Хлебобулочные изделия',
            'parent_id' => $food->id,
            'level' => 2,
        ]);

        // Уровень 2 - Автомобили
        $trucks = Activity::create([
            'name' => 'Грузовые',
            'parent_id' => $cars->id,
            'level' => 2,
        ]);

        $passenger = Activity::create([
            'name' => 'Легковые',
            'parent_id' => $cars->id,
            'level' => 2,
        ]);

        // Уровень 3 - Легковые автомобили
        Activity::create([
            'name' => 'Запчасти',
            'parent_id' => $passenger->id,
            'level' => 3,
        ]);

        Activity::create([
            'name' => 'Аксессуары',
            'parent_id' => $passenger->id,
            'level' => 3,
        ]);
    }
}
