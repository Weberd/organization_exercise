<?php

namespace App\Http\Controllers\Api\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationByIdRequest;
use App\Http\Resources\OrganizationResource;
use App\Services\OrganizationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class SearchOrganizationsByActivityWithChildrenController extends Controller
{
    public function __construct(private OrganizationService $organizationService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/v1/organizations/activity/children/{id}",
     *     summary="Искать организации по виду деятельности (включая вложенные)",
     *     tags={"Organizations"},
     *     security={{"apiKey":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer"), description="Идентификатор вида деятельности"),
     *     @OA\Response(response=200, description="Успешный ответ"),
     *     @OA\Response(response=422, description="Неправильный идентификатор")
     * )
     */
    public function __invoke(OrganizationByIdRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();
        return OrganizationResource::collection($this->organizationService->searchByActivityWithChildren($data['id']));
    }
}
