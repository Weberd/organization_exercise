<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\OrganizationPhone;
use App\Models\Building;
use App\Models\Activity;
use Illuminate\Database\Seeder;

class OrganizationSeeder extends Seeder
{
    public function run(): void
    {
        $buildings = Building::all();
        $activities = Activity::all();

        $organizations = [
            [
                'name' => 'ООО "Рога и Копыта"',
                'phones' => ['2-222-222', '3-333-333', '8-923-666-13-13'],
                'activity_names' => ['Мясная продукция', 'Молочная продукция'],
            ],
            [
                'name' => 'ИП Петров',
                'phones' => ['8-495-123-45-67'],
                'activity_names' => ['Хлебобулочные изделия'],
            ],
            [
                'name' => 'ЗАО "МясоПром"',
                'phones' => ['8-800-555-35-35', '8-495-777-88-99'],
                'activity_names' => ['Мясная продукция'],
            ],
            [
                'name' => 'ООО "АвтоТрейд"',
                'phones' => ['8-926-123-45-67'],
                'activity_names' => ['Легковые', 'Запчасти'],
            ],
            [
                'name' => 'ООО "ГрузоВоз"',
                'phones' => ['8-495-100-20-30'],
                'activity_names' => ['Грузовые'],
            ],
            [
                'name' => 'ООО "Молочный Мир"',
                'phones' => ['8-495-555-12-12', '8-926-333-44-55'],
                'activity_names' => ['Молочная продукция'],
            ],
            [
                'name' => 'ИТ Консалт Групп',
                'phones' => ['8-495-999-88-77'],
                'activity_names' => ['Разработка ПО', 'Системная интеграция'],
            ],
            [
                'name' => 'Бизнес Консультант',
                'phones' => ['8-495-777-66-55'],
                'activity_names' => ['Консалтинг'],
            ],
            [
                'name' => 'АвтоАксессуары Плюс',
                'phones' => ['8-926-444-55-66'],
                'activity_names' => ['Аксессуары'],
            ],
            [
                'name' => 'Продукты Питания №1',
                'phones' => ['8-495-200-30-40', '8-926-100-20-30'],
                'activity_names' => ['Еда'],
            ],
        ];

        foreach ($organizations as $index => $orgData) {
            $organization = Organization::create([
                'name' => $orgData['name'],
                'building_id' => $buildings->random()->id,
            ]);

            // Добавляем телефоны
            foreach ($orgData['phones'] as $phone) {
                OrganizationPhone::create([
                    'organization_id' => $organization->id,
                    'phone' => $phone,
                ]);
            }

            // Добавляем виды деятельности
            foreach ($orgData['activity_names'] as $activityName) {
                $activity = $activities->firstWhere('name', $activityName);
                if ($activity) {
                    $organization->activities()->attach($activity->id);
                }
            }
        }
    }
}
