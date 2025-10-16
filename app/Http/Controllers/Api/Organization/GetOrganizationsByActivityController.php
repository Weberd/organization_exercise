<?php

namespace App\Http\Controllers\Api\Organization;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;
use App\Services\OrganizationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class GetOrganizationsByActivityController extends Controller
{
    public function __construct(private readonly OrganizationService $organizationService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/v1/organizations/activity/{id}",
     *     summary="Список всех организаций, которые относятся к указанному виду деятельности",
     *     tags={"Organizations"},
     *     security={{"apiKey":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
     *     @OA\Response(response=200, description="Успешный ответ")
     * )
     */
    public function __invoke(int $id): AnonymousResourceCollection
    {
        return OrganizationResource::collection($this->organizationService->getByActivityId($id));
    }
}
