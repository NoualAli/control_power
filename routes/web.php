<?php

use App\Http\Controllers\Api\ControlCompaignController;
use App\Http\Controllers\Api\MissionController;
use App\Http\Controllers\ExcelReaderController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/excel-reader', ExcelReaderController::class);

Route::prefix('missions')->controller(MissionController::class)->group(function () {
    Route::get('/{mission}/report', 'handleReport');
});
