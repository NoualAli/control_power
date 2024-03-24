<?php

use App\Http\Controllers\Api\V1\Structures\AgencyController;
use App\Http\Controllers\Api\V1\Structures\AgencyCategoriesController;
use App\Http\Controllers\Api\V1\Structures\DreController;
use App\Http\Controllers\Api\V1\Structures\RegionalInspectionController;
use Illuminate\Support\Facades\Route;

/**
 * Structures management
 */
Route::prefix('structures')->group(function () {
    /**
     * Regional inspections
     */
    Route::prefix('regional-inspections')->controller(RegionalInspectionController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{regional_inspection}', 'show');
        Route::post('/', 'store');
        Route::put('{regional_inspection}', 'update');
        Route::delete('{regional_inspection}', 'destroy');
    });

    /**
     * Dre
     */
    Route::prefix('dre')->controller(DreController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{dre}', 'show');
        Route::post('/', 'store');
        Route::put('{dre}', 'update');
        Route::delete('{dre}', 'destroy');
    });

    /**
     * Agencies
     */
    Route::prefix('agencies')->controller(AgencyController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{agency}', 'show');
        Route::get('concerns/config', 'config');
        Route::post('/', 'store');
        Route::put('{agency}', 'update');
        Route::delete('{agency}', 'destroy');
    });

    /**
     * Agency categories
     */
    Route::prefix('agency-categories')->controller(AgencyCategoriesController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{category}', 'show');
        Route::get('concerns/config', 'config');
        Route::post('/', 'store');
        Route::put('{category}', 'update');
        Route::delete('{category}', 'destroy');
    });
});
