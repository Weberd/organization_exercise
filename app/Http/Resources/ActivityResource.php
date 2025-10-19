<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="ActivityResource",
 *     type="object",
 *     title="Activity Resource",
 *     @OA\Property(property="id", type="integer", example=3),
 *     @OA\Property(property="name", type="string", example="Мясная продукция"),
 *     @OA\Property(property="level", type="integer", example=2),
 *     @OA\Property(property="parent_id", type="integer", example=1),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-10-18T13:13:21.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-10-18T13:13:21.000000Z")
 * )
 */
class ActivityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'level' => $this->level,
            'parent_id' => $this->parent_id,
            'children' => ActivityResource::collection($this->whenLoaded('children')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
