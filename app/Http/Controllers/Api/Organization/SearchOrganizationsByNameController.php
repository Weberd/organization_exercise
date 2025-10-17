<?php

namespace App\Http\Controllers\Api\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationByNameRequest;
use App\Http\Resources\OrganizationResource;
use App\Services\OrganizationService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class SearchOrganizationsByNameController extends Controller
{
    public function __construct(private readonly OrganizationService $organizationService)
    {
    }

    /**
     * @OA\Get(
     *     path="/api/v1/organizations/name/{name}",
     *     summary="Поиск организаций по названию",
     *     tags={"Organizations"},
     *     security={{"apiKey":{}}},
     *     @OA\Parameter(
     *         name="name",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="string"),
     *         description="Название организации"
     *     ),
     *     @OA\Response(response=200, description="Успешный ответ"),
     *     @OA\Response(response=422, description="Невереный шаблон имени")
     * )
     */
    public function __invoke(OrganizationByNameRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();
        return OrganizationResource::collection($this->organizationService->searchByName($data['name']));
    }
}
