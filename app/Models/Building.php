<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'location',
    ];

    protected $appends = ['latitude', 'longitude'];

    /**
     * Latitude accessor.
     */
    public function getLatitudeAttribute()
    {
        if (!isset($this->attributes['location'])) {
            return null;
        }

        return DB::table($this->table)
            ->selectRaw('ST_Y(location) as lat')
            ->where('id', $this->id)
            ->limit(1)
            ->value('lat');
    }

    /**
     * Longitude accessor.
     */
    public function getLongitudeAttribute()
    {
        if (!isset($this->attributes['location'])) {
            return null;
        }

        return DB::table($this->table)
            ->selectRaw('ST_X(location) as lng')
            ->where('id', $this->id)
            ->limit(1)
            ->value('lng');
    }

    public function organizations(): HasMany
    {
        return $this->hasMany(Organization::class);
    }
}
