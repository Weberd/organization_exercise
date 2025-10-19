<?php

namespace Tests;

use App\Models\Organization;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\Fluent\AssertableJson;

abstract class TestCase extends BaseTestCase
{
    protected function checkJsonOrganization(AssertableJson $json, Organization $organization): AssertableJson
    {
        return $json->where('data.id', $organization->id)
            ->where('data.name', $organization->name)
            ->where('data.building.id', $organization->building->id)
            ->where('data.building.address', $organization->building->address)
            ->where('data.building.latitude', $organization->building->latitude)
            ->where('data.building.longitude', $organization->building->longitude)
            ->where('data.phones', $organization->phones)
            ->where('data.activities', $organization->activities)
            ->where('data.created_at', $organization->created_at->toISOString())
            ->where('data.updated_at', $organization->updated_at->toISOString())
            ->etc();
    }
}
