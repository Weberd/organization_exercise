<?php

use App\Http\Controllers\Api\Organization\GetOrganizationByIdController;
use App\Http\Controllers\Api\Organization\GetOrganizationsByActivityController;
use App\Http\Controllers\Api\Organization\GetOrganizationsByBuildingController;
use App\Http\Controllers\Api\Organization\SearchOrganizationsByGeoRadiusController;
use App\Http\Controllers\Api\Organization\SearchOrganizationsByGeoRectangleController;
use App\Http\Controllers\Api\Organization\SearchOrganizationsByActivityWithChildrenController;
use App\Http\Controllers\Api\Organization\SearchOrganizationsByNameController;
use Illuminate\Support\Facades\Route;

Route::middleware(['api.key'])->group(function () {

    // Organizations
    Route::prefix('v1/organizations')->group(function () {
        Route::get('/building/{id}', GetOrganizationsByBuildingController::class);
        Route::get('/activity/{id}', GetOrganizationsByActivityController::class);
        Route::get('/geo-circle/{lng}/{lat}/{radius}', SearchOrganizationsByGeoRadiusController::class);
        Route::get('/geo-rectangle/{min_lng}/{min_lat}/{max_lng}/{max_lat}', SearchOrganizationsByGeoRectangleController::class);
        Route::get('/{id}', GetOrganizationByIdController::class);
        Route::get('/activity/children/{id}', SearchOrganizationsByActivityWithChildrenController::class);
        Route::get('/name/{name}', SearchOrganizationsByNameController::class);
    });
});
