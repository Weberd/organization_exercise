<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE buildings ADD COLUMN location POINT NOT NULL');
        DB::statement('ALTER TABLE buildings ADD SPATIAL INDEX buildings_location_spatialindex (location)');
    }

    public function down(): void
    {
        Schema::dropIfExists('buildings');
    }
};
