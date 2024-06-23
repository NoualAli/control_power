<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\BackupController;
use App\Http\Controllers\Api\BugController;
use App\Http\Controllers\Api\CommentController;

use App\Http\Controllers\Api\ControlPointController;
use App\Http\Controllers\Api\DomainController;
use App\Http\Controllers\Api\FamilyController;
use App\Http\Controllers\Api\FieldController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ProcessController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Settings\PasswordController;
use App\Http\Controllers\Api\ReferenceController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\NotificationSettingController;
use App\Http\Controllers\Api\Settings\SettingController;
use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\PCFController;

Route::group(['middleware' => 'auth:api'], function () {
    /**
     * Logout user
     */
    Route::post('logout', [LoginController::class, 'logout']);

    /**
     * Fetch current logged user
     */
    Route::get('user', [UserController::class, 'current']);

    /**
     * Accessible only if user is_active => true
     */
    Route::group(['middleware' => 'is_active'], function () {

        /**
         * User settings
         */
        Route::prefix('settings')->group(function () {
            Route::patch('password/{user}', [PasswordController::class, 'update']);
            Route::patch('reset/{user}', [SettingController::class, 'reset']);
        });

        /**
         * Backups
         */
        Route::prefix('backup-db')->controller(BackupController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::delete('{filename}', 'destroy');
        });

        // Roles routes
        Route::prefix('roles')->controller(RoleController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('{role}', 'show');
            Route::post('/', 'store');
            Route::put('{role}', 'update');
            Route::delete('{role}', 'destroy');
        });

        // Modules routes
        Route::prefix('modules')->controller(ModuleController::class)->group(function () {
            Route::get('/', 'index');
            Route::put('/', 'manage');
        });

        // Users
        Route::prefix('users')->controller(UserController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('{user}', 'show');
            Route::get('/logins/history', 'loginsHistory');
            Route::post('/', 'store');
            Route::put('info/{user}', 'updateInfo');
            Route::put('password/{user}', 'updatePassword');
            Route::post('reset/{user}', 'reset');
            Route::delete('{user}', 'destroy');
        });

        /**
         * Reference
         */
        Route::prefix('references')->controller(ReferenceController::class)->group(function () {
            Route::get('pcf', 'index');
            Route::get('pcf/{process}', 'show');
        });

        Route::prefix('pcf')->controller(PCFController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('{media_id}', 'show');
            Route::get('info/list/{media_id?}', 'info');
            Route::post('/', 'store');
            Route::put('{media_id}', 'update');
            Route::delete('{media_id}', 'destroy');
        });

        /**
         * Famillies -> Domains -> Processes -> Control Points
         */
        Route::prefix('families')->controller(FamilyController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('{family}', 'show');
            Route::get('concerns/config/{family?}', 'config');
            Route::post('/', 'store');
            Route::put('{family}', 'update');
            Route::patch('{family}', 'toggleState');
            Route::delete('{family}', 'destroy');
        });


        Route::prefix('domains')->controller(DomainController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('{domain}', 'show');
            Route::get('concerns/config/{family?}', 'config');
            Route::get('config/{domain?}', 'config');
            Route::post('/', 'store');
            Route::put('{domain}', 'update');
            Route::patch('{domain}', 'toggleState');
            Route::delete('{domain}', 'destroy');
        });

        Route::prefix('processes')->controller(ProcessController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('{process}', 'show');
            // Route::get('config/{process?}', 'config');
            Route::get('concerns/config/{domain?}', 'config');
            Route::post('/', 'store');
            Route::put('{process}', 'update');
            Route::patch('{process}', 'toggleState');
            Route::delete('{process}', 'destroy');
        });

        Route::prefix('control-points')->controller(ControlPointController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('{controlPoint}', 'show');
            // Route::get('config/{controlPoint?}', 'config');
            Route::get('concerns/config/{process?}', 'config');
            Route::post('/', 'store');
            Route::put('{controlPoint}', 'update');
            Route::patch('{controlPoint}', 'toggleState');
            Route::delete('{controlPoint}', 'destroy');
        });

        /**
         * Fields
         */
        Route::prefix('fields')->controller(FieldController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('{field}', 'show');
            Route::post('/', 'store');
            Route::put('{field}', 'update');
            Route::delete('{field}', 'destroy');
        });

        /**
         * Structures management
         */

        include_once __DIR__ . '/structures.php';

        /**
         * Agency level
         */

        include_once __DIR__ . '/agency_level.php';

        /**
         * Media
         */
        Route::prefix('media')->controller(MediaController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('{media}', 'show');
            Route::post('/', 'store');
            Route::delete('{media}', 'destroy');
            Route::delete('{media}/multiple', 'destroyMultiple');
        });

        /**
         * Notifications
         */
        Route::prefix('notifications')->controller(NotificationController::class)->group(function () {
            Route::get('/', 'index');
            Route::put('/', 'read');
            Route::get('unreadNotifications', 'unreadNotifications');
            Route::post('read-major-facts', 'read_major_facts');
            Route::prefix('settings')->controller(NotificationSettingController::class)->group(function () {
                Route::get('{user}', 'index');
                Route::put('{user}', 'update');
            });
        });

        /**
         * Bugs
         */
        Route::prefix('bugs')->controller(BugController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::get('{bug}', 'show');
            Route::put('{bug}', 'resolve');
        });

        /**
         * Comments
         */
        Route::prefix('comments')->controller(CommentController::class)->group(function () {
            Route::get('{comment}', 'show');
        });
    });
});
