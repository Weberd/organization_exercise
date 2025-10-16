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
     * *         @OA\Schema(type="float"),
     *           description="Широта начальной точки"
     * *   ),
     * *   @OA\Parameter(
     * *         name="lat",
     * *         in="path",
     * *         required=true,
     * *         @OA\Schema(type="float"),
     *           description="Долгота начальное точки"
     * *   ),
     * *   @OA\Parameter(
     * *         name="raidus",
     * *         in="path",
     * *         required=true,
     * *         @OA\Schema(type="float"),
     *           description="Радиус"
     * *   ),
     * *   @OA\Response(response=200, description="Успешный ответ")
     * )
     */
    public function __invoke(float $latitude, float $longitude, float $radius): AnonymousResourceCollection
    {
        return OrganizationResource::collection($this->organizationService->searchInRadius($latitude, $longitude, $radius));
    }
}
