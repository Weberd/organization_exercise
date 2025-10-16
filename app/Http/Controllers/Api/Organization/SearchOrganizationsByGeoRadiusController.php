<?php

namespace App\Http\Controllers\Api\Organization;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;
use App\Services\OrganizationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class SearchOrganizationsByGeoRadiusController extends Controller
{
    public function __construct(private readonly OrganizationService $organizationService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/v1/organizations/geo-circle/{lat}/{lng}/{radius}",
     *     summary="Список организаций, которые находятся в заданном радиусе относительно указанной точки на карте. список зданий",
     *     tags={"Organizations"},
     *     security={{"apiKey":{}}},
     *     @OA\Parameter(
     * *         name="lat",
     * *         in="path",
     * *         required=true,
     * *         @OA\Schema(type="float")
     * *     ),
     * *    @OA\Parameter(
     * *         name="lat",
     * *         in="path",
     * *         required=true,
     * *         @OA\Schema(type="float")
     * *     ),
     * *    @OA\Parameter(
     * *         name="raidus",
     * *         in="path",
     * *         required=true,
     * *         @OA\Schema(type="float")
     * *     ),
     * *    @OA\Response(response=200)
     * )
     */
    public function __invoke(float $latitude, float $longitude, float $radius): AnonymousResourceCollection
    {
        return OrganizationResource::collection($this->organizationService->searchInRadius($latitude, $longitude, $radius));
    }
}
