<?php

namespace App\Http\Controllers\Api\Organization;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrganizationResource;
use App\Services\OrganizationService;

final class GetOrganizationByIdController extends Controller
{
    public function __construct(
        private readonly OrganizationService $organizationService
    ) {
    }

    /**
     * @OA\Get(
     *     path="/ap/v1/organizations/{id}",
     *     summary="Вывод информации об организации по её идентификатору",
     *     tags={"Organizations"},
     *     security={{"apiKey":{}}},
     *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer"), description="Идентификатор организации"),
     *     @OA\Response(response=200, description="Успешный ответ"),
     *     @OA\Response(response=404, description="Организация не найдена")
     * )
     */
    public function __invoke(int $id): OrganizationResource
    {
        return new OrganizationResource($this->organizationService->getById($id));
    }
}
