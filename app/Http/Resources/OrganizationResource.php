<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="OrganizationResource",
 *     type="object",
 *     title="Organization Resource",
 *     description="Organization with related building, activities and phones",
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="ООО 'Рога и Копыта'"),
 *     @OA\Property(
 *         property="phones",
 *         type="array",
 *         @OA\Items(type="string", example="8-923-666-13-13")
 *     ),
 *     @OA\Property(property="building", ref="#/components/schemas/BuildingResource"),
 *     @OA\Property(
 *         property="activities",
 *         type="array",
 *         @OA\Items(ref="#/components/schemas/ActivityResource")
 *     ),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-18T13:13:21.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-18T13:13:21.000000Z")
 * )
 */
class OrganizationResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phones' => $this->phones->pluck('phone')->toArray(),
            'building' => new BuildingResource($this->whenLoaded('building')),
            'activities' => ActivityResource::collection($this->whenLoaded('activities')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
