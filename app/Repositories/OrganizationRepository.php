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
        $activity = Activity::findOrFail($activityId);
        $activityIds = $activity->getAllChildrenIds();

        $organizations = Organization::whereHas('activities', function ($query) use ($activityIds) {
            $query->whereIn('activities.id', $activityIds);
        })
            ->with(['building', 'phones', 'activities'])
            ->get();

        return $organizations;
    }

    public function searchByActivityName(string $activityQuery): Collection
    {
        return Organization::whereHas('activities', function ($query) use ($activityQuery) {
            $query->where('name', 'like', "%{$activityQuery}%");
        })
            ->with(['building', 'phones', 'activities'])
            ->get();
    }

    public function searchByName(string $nameQuery): Collection
    {
        return Organization::where('name', 'like', "%{$nameQuery}%")
            ->with(['building', 'phones', 'activities'])
            ->get();
    }

    public function getByBuildingIds(Collection $buildings): Collection
    {
        return Organization::whereIn('building_id', $buildings)
            ->with(['building', 'phones', 'activities'])
            ->get();
    }
}
