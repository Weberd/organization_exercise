<?php

namespace App\Repositories;

use App\Models\Activity;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Collection;

class OrganizationRepository
{
    public function getById(int $id): Organization
    {
        return Organization::with(['building', 'phones', 'activities'])->findOrFail($id);
    }

    public function getByBuildingId(int $buildingId): Collection
    {
        return Organization::where('building_id', $buildingId)
            ->with(['building', 'phones', 'activities'])
            ->get();
    }

    public function getByActivityId(int $activityId): Collection
    {
        return Organization::whereHas('activities', function ($query) use ($activityId) {
            $query->where('activities.id', $activityId);
        })->get();
    }

    public function searchByActivityWithChildren(int $activityId): Collection
    {
        $activity = Activity::findOrFail($activityId);
        $activityIds = $activity->getAllChildrenIds();

        $organizations = Organization::whereHas('activities', function ($query) use ($activityIds) {
            $query->whereIn('activities.id', $activityIds);
        })
            ->with(['building', 'phones', 'activities'])
            ->get();

        return $organizations;
    }

    public function searchByName(string $nameQuery): Collection
    {
        return Organization::where('name', 'like', "%{$nameQuery}%")
            ->with(['building', 'phones', 'activities'])
            ->get();
    }

    public function getByBuildingIds(Collection $buildings): Collection
    {
        $buildingIds = $buildings->pluck('id');

        return Organization::whereIn('building_id', $buildingIds)
            ->with(['building', 'phones', 'activities'])
            ->get();
    }
}
