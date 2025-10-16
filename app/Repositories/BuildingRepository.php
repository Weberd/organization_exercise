<?php

namespace App\Repositories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Collection;

class BuildingRepository
{
    public function getBuildingsInRadius(float $latitude, float $longitude, float $radius): Collection
    {
        $radiusInKm = $radius / 1000;

        // Используем формулу Haversine для расчета расстояния
        $buildings = Building::selectRaw("
            id,
            address,
            latitude,
            longitude,
            (6371 * acos(
                cos(radians(?)) *
                cos(radians(latitude)) *
                cos(radians(longitude) - radians(?)) +
                sin(radians(?)) *
                sin(radians(latitude))
            )) AS distance
        ", [$latitude, $longitude, $latitude])
            ->having('distance', '<=', $radiusInKm)
            ->orderBy('distance')
            ->get();

        return $buildings->pluck('id');
    }

    public function getBuildingsInRectangle(
        float $minLat,
        float $maxLat,
        float $minLng,
        float $maxLng
    ): Collection {
        $buildings = Building::whereBetween('latitude', [$minLat, $maxLat])
            ->whereBetween('longitude', [$minLng, $maxLng])
            ->get();

        return $buildings->pluck('id');
    }
}
