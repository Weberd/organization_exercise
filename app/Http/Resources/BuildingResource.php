<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="BuildingResource",
 *     type="object",
 *     title="Building Resource",
 *     @OA\Property(property="id", type="integer", example=7),
 *     @OA\Property(property="address", type="string", example="г. Москва, ул. Арбат, д. 53"),
 *     @OA\Property(property="longitude", type="number", format="float", example=37.58878),
 *     @OA\Property(property="latitude", type="number", format="float", example=55.74984),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-18T13:13:21.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-18T13:13:21.000000Z")
 * )
 */
class BuildingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'longitude' => (float) $this->longitude,
            'latitude' => (float) $this->latitude,
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
