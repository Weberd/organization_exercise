<?php

namespace App\Http\Controllers\Api\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationsByGeoRadiusRequest;
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
     *     path="/api/v1/organizations/geo-circle/{lng}/{lat}/{radius}",
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
     *           description="Радиус в метраз"
     * *   ),
     *     @OA\Response(response=200,
     * * *       description="Успешный ответ",
     * *         @OA\JsonContent(
     * * *             type="object",
     * * *             @OA\Property(
     * * *                 property="data",
     * * *                 type="array",
     * * *                 description="Список организаций",
     * * *                 @OA\Items(ref="#/components/schemas/OrganizationResource")
     * * *             )
     * * *         )
     * * *     ),
     *     @OA\Response(response=422, description="Неправильные параметры")
     * )
     */
    public function __invoke(OrganizationsByGeoRadiusRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();
        return OrganizationResource::collection($this->organizationService->searchInRadius($data['latitude'], $data['longitude'], $data['radius']));
    }
}
