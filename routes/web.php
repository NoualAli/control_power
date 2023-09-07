<?php

use App\Http\Controllers\Api\ControlCompaignController;
use App\Http\Controllers\Api\MissionController;
use App\Http\Controllers\ExcelReaderController;
use App\Models\Mission;
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

Route::prefix('excel-reader')->controller(ExcelReaderController::class)->group(function () {
    // Route::get('load-pcf', 'loadPCF');
    // Route::get('create-users', 'createUsers');
    Route::get('load-references', 'loadReferences');
})->name('excel');

Route::prefix('missions')->controller(MissionController::class)->group(function () {
    Route::get('/{mission}/report', 'handleReport');
    Route::get('{mission}/metadata/test', function (Mission $mission) {
        $details = $mission->details;
        foreach ($details as $detail) {
            if ($detail->metadata) {
                dd($detail->parsed_metadata);
            }
        }
    });
});
