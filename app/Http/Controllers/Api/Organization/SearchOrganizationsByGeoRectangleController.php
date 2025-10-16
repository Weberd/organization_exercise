<?php

namespace App\Http\Controllers\Api\Organization;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;
use App\Services\OrganizationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class SearchOrganizationsByGeoRectangleController extends Controller
{
    public function __construct(private readonly OrganizationService $organizationService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/v1/organizations/geo-rectangle/{min_lat}/{max_lat}/{min_lng}/{max_lng}",
     *     summary="Список организаций, которые находятся в заданном прямоугольной области относительно указанной точки на карте. список зданий",
     *     tags={"Organizations"},
     *     security={{"apiKey":{}}},
     *     @OA\Parameter(
     * *         name="min_lat",
     * *         in="path",
     * *         required=true,
     * *         @OA\Schema(type="float"),
     *           description="Широта левой верхней точки прямоугольника"
     * *     ),
     * *    @OA\Parameter(
     * *         name="max_lat",
     * *         in="path",
     * *         required=true,
     * *         @OA\Schema(type="float"),
     *           description="Широта правой нижней точки прямоугольника"
     * *     ),
     * *    @OA\Parameter(
     * *         name="min_lng",
     * *         in="path",
     * *         required=true,
     * *         @OA\Schema(type="float"),
     *           description="Долгота левой верхней точки прямоугольника"
     * *     ),
     * *    @OA\Parameter(
     * *         name="max_lng",
     * *         in="path",
     * *         required=true,
     * *         @OA\Schema(type="float"),
     *           description="Долгота правой нижней точки прямоугольника"
     * *     ),
     * *    @OA\Response(response=200, description="Успешный ответ")
     * )
     */
    public function __invoke(
        float $minLat,
        float $maxLat,
        float $minLng,
        float $maxLng
    ): AnonymousResourceCollection
    {
        return OrganizationResource::collection($this->organizationService->searchInRectangle($minLat, $maxLat, $minLng, $maxLng));
    }
}
