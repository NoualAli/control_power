<?php

use App\Http\Controllers\Api\Structures\AgencyController;
use App\Http\Controllers\Api\Structures\AgencyCategoriesController;
use App\Http\Controllers\Api\Structures\DepartmentController;
use App\Http\Controllers\Api\Structures\DreController;
use App\Http\Controllers\Api\Structures\RegionalInspectionController;
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
     * Departments
     */
    Route::prefix('departments')->controller(DepartmentController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{department}', 'show');
        Route::post('/', 'store');
        Route::put('{department}', 'update');
        Route::delete('{department}', 'destroy');
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
