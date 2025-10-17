<?php

namespace App\Http\Controllers\Api\Organization;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrganizationByIdRequest;
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
     *     @OA\Response(response=404, description="Организация не найдена"),
     *     @OA\Response(response=422, description="Неправильный идентификатор")
     * )
     */
    public function __invoke(OrganizationByIdRequest $request): OrganizationResource
    {
        $data = $request->validated();
        return new OrganizationResource($this->organizationService->getById($data['id']));
    }
}
