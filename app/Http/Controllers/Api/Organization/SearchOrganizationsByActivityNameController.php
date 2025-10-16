<?php

namespace App\Http\Controllers\Api\Organization;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;
use App\Services\OrganizationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class SearchOrganizationsByActivityNameController extends Controller
{
    public function __construct(private OrganizationService $organizationService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/v1/organizations/activity/name/{name}",
     *     summary="Искать организации по виду деятельности (включая вложенные)",
     *     tags={"Organizations"},
     *     security={{"apiKey":{}}},
     *     @OA\Parameter(
     * *         name="name",
     * *         in="path",
     * *         required=true,
     * *         @OA\Schema(type="string"),
     *           description="Название вида деятельности"
     * *     ),
     * *     @OA\Response(response=200, description="Успешный ответ")
     * )
     */
    public function __invoke(string $name): AnonymousResourceCollection
    {
        return OrganizationResource::collection($this->organizationService->searchByActivityName($name));
    }
}
