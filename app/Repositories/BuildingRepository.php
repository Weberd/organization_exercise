<?php

namespace App\Repositories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Collection;

class BuildingRepository
{
    public function getBuildingsInRadius(float $latitude, float $longitude, float $radius): Collection
    {
        // Используем формулу Haversine для расчета расстояния
        $buildings = Building::selectRaw("
            id,
            ST_Distance_Sphere(
                location,
                POINT(?, ?)
            ) AS distance
        ", [$longitude, $latitude])
            ->having('distance', '<=', $radius)
            ->orderBy('distance')
            ->get();

        return $buildings;
    }

    public function getBuildingsInRectangle(
        float $minLng,
        float $minLat,
        float $maxLng,
        float $maxLat
    ): Collection {
        $buildings = Building::whereRaw(
            'ST_Contains(
                ST_MakeEnvelope(POINT(?, ?), POINT(?, ?)),
                location
            )',
            [$minLng, $minLat, $maxLng, $maxLat]
        )->get();

        return $buildings;
    }
}
