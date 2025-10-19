<?php

namespace Tests\Feature;

use App\Models\Organization;
use Illuminate\Testing\Fluent\AssertableJson;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class GetOrganizationByIdControllerTest extends TestCase
{
    #[Test]
    public function it_returns_organization_by_id_successfully()
    {
        $organization = Organization::factory()->create();
        $response = $this->withHeaders([
            'API-KEY' => config('app.api_key'),
            'Accept' => 'application/json',
        ])->getJson("/api/v1/organizations/{$organization->id}");

        $response
            ->assertOk()
            ->assertJson(fn (AssertableJson $json) => $this->checkJsonOrganization($json, $organization));
    }

    #[Test]
    public function it_returns_404_if_organization_not_found()
    {
        $nonExistingId = 999999;

        $response = $this->withHeaders([
            'API-KEY' => config('app.api_key'),
            'Accept' => 'application/json',
        ])->getJson("/api/v1/organizations/{$nonExistingId}");

        // Assert
        $response
            ->assertNotFound()
            ->assertJson(fn (AssertableJson $json) =>
                $json->where('message', 'Resource not found')
                ->etc()
            );
    }

    #[Test]
    public function it_returns_422_if_id_is_invalid()
    {
        // Act
        $response = $this->withHeaders([
            'API-KEY' => config('app.api_key'),
            'Accept' => 'application/json',
        ])->getJson('/api/v1/organizations/invalid-id');

        // Assert
        $response
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['id']);
    }
}
