<?php

use App\Helpers\Data\Data;
use App\Helpers\Data\Users;
use App\Http\Controllers\Api\V1\Mission\MissionController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\BackupController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\ZipController;
use App\Notifications\TestNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
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

Route::prefix('excel-export')->controller(ExportController::class)->group(function () {
    Route::get('/', 'export');
});

Route::prefix('backup-db')->controller(BackupController::class)->group(function () {
    Route::get('{filname}', 'download');
});

Route::prefix('zip')->controller(ZipController::class)->group(function () {
    Route::get('{type}/{id}', 'download');
});

Route::prefix('missions')->controller(MissionController::class)->group(function () {
    Route::get('/{mission}/report', 'handleReport');
});

Route::get('logout', [LoginController::class, 'logout']);

if (hasRole('root')) {
    Route::get('test-notifications', function () {
        Notification::send(auth()->user(), new TestNotification);
    });
}
