<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'parent_id',
        'level',
    ];

    protected $casts = [
        'level' => 'integer',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Activity::class, 'parent_id');
    }

    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class);
    }

    /**
     * Получить все дочерние ID (включая вложенные)
     */
    public function getAllChildrenIds(): array
    {
        $ids = [$this->id];

        foreach ($this->children as $child) {
            $ids = array_merge($ids, $child->getAllChildrenIds());
        }

        return $ids;
    }

    /**
     * Boot метод для валидации уровня вложенности
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($activity) {
            if ($activity->level > 3) {
                throw new \Exception('Maximum activity nesting level is 3');
            }

            if ($activity->parent_id) {
                $parent = Activity::find($activity->parent_id);
                if ($parent) {
                    $activity->level = $parent->level + 1;

                    if ($activity->level > 3) {
                        throw new \Exception('Maximum activity nesting level is 3');
                    }
                }
            }
        });
    }
}
