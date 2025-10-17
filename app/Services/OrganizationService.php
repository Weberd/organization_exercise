<?php

namespace App\Services;

use App\Models\Organization;
use App\Repositories\BuildingRepository;
use App\Repositories\OrganizationRepository;
use Illuminate\Database\Eloquent\Collection;

class OrganizationService
{
    public function __construct(
        private OrganizationRepository $organizationRepository,
        private BuildingRepository $buildingRepository,
    ) {
    }

    public function getById(int $id): Organization
    {
        return $this->organizationRepository->getById($id);
    }

    public function getByBuildingId(int $buildingId): Collection
    {
        return $this->organizationRepository->getByBuildingId($buildingId);
    }

    public function getByActivityId(int $activityId): Collection
    {
        return $this->organizationRepository->getByActivityId($activityId);
    }

    public function searchByActivityWithChildren(int $activityId): Collection
    {
        return $this->organizationRepository->searchByActivityWithChildren($activityId);
    }

    public function searchByName(string $nameQuery): Collection
    {
        return $this->organizationRepository->searchByName($nameQuery);
    }

    public function searchInRadius(float $latitude, float $longitude, float $radius): Collection
    {
        $buildings = $this->buildingRepository->getBuildingsInRadius($latitude, $longitude, $radius);
        return $this->organizationRepository->getByBuildingIds($buildings);
    }

    public function searchInRectangle(
        float $minLng,
        float $minLat,
        float $maxLng,
        float $maxLat,
    ): Collection
    {
        $buildings = $this->buildingRepository->getBuildingsInRectangle($minLng, $minLat, $maxLng, $maxLat);
        return $this->organizationRepository->getByBuildingIds($buildings);
    }
}
