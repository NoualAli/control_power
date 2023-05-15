<?php

use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\AgencyController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ControlCampaignController;
use App\Http\Controllers\Api\ControlPointController;
use App\Http\Controllers\Api\DomainController;
use App\Http\Controllers\Api\DreController;
use App\Http\Controllers\Api\FamillyController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\MissionController;
use App\Http\Controllers\Api\MissionDetailController;
use App\Http\Controllers\Api\MissionReportController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ProcessController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Settings\PasswordController;
use App\Http\Controllers\Api\Settings\ProfileController;
use App\Http\Controllers\Api\ReferenceController;
use App\Http\Controllers\Api\RegularizationController;
use App\Http\Controllers\Api\Settings\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [LoginController::class, 'logout']);

    Route::get('user', [UserController::class, 'current']);

    Route::patch('settings/profile/{user}', [ProfileController::class, 'update']);
    Route::patch('settings/password/{user}', [PasswordController::class, 'update']);
    Route::get('settings/laravel/rules', [SettingController::class, 'getValidationRules']);

    // Roles routes
    Route::prefix('roles')->controller(RoleController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{role}', 'show');
        Route::post('/', 'store');
        Route::put('{role}', 'update');
        Route::delete('{role}', 'destroy');
    });

    // Permissions routes
    Route::prefix('permissions')->controller(PermissionController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{permission}', 'show');
        Route::post('/', 'store');
        Route::put('{permission}', 'update');
        Route::delete('{permission}', 'destroy');
    });

    // Users
    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{user}', 'show');
        Route::get('/logins/history', 'loginsHistory');
        Route::post('/', 'store');
        Route::put('info/{user}', 'updateInfo');
        Route::put('password/{user}', 'updatePassword');
        Route::delete('{user}', 'destroy');
    });

    /**
     * Reference
     */
    Route::prefix('references')->group(function () {
        Route::get('/pcf', [ReferenceController::class, 'pcf']);
    });

    /**
     * Famillies -> Domains -> Processes -> Control Points
     */
    Route::prefix('famillies')->controller(FamillyController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{familly}', 'show');
        Route::post('/', 'store');
        Route::put('{familly}', 'update');
        Route::delete('{familly}', 'destroy');
    });


    Route::prefix('domains')->controller(DomainController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{domain}', 'show');
        Route::post('/', 'store');
        Route::put('{domain}', 'update');
        Route::delete('{domain}', 'destroy');
    });

    Route::prefix('processes')->controller(ProcessController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{process}', 'show');
        Route::post('/', 'store');
        Route::put('{process}', 'update');
        Route::delete('{process}', 'destroy');
    });

    Route::prefix('control-points')->controller(ControlPointController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{controlPoint}', 'show');
        Route::post('/', 'store');
        Route::put('{controlPoint}', 'update');
        Route::delete('{controlPoint}', 'destroy');
    });

    /**
     * Control campaigns
     */
    Route::prefix('campaigns')->controller(ControlCampaignController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('/current', 'current');
        Route::get('/next-reference', 'getNextReference');
        Route::get('/{campaign}', 'show');
        Route::get('/processes/{campaign}', 'processes');
        Route::put('/{campaign}', 'update');
        Route::put('/{campaign}/validate', 'validateCampaign');
        Route::delete('{campaign}', 'destroy');
        Route::delete('{campaign}/process/{process}', 'destroyProcess');
    });

    /**
     * Missions
     */
    Route::prefix('missions')->controller(MissionController::class)->group(function () {
        Route::post('/', 'store');
        Route::get('/', 'index');
        Route::get('/{mission}', 'show');
        Route::get('/{mission}/export', 'export');
        Route::put('{mission}', 'update');
        Route::put('{mission}/assign', 'assignToCC');
        Route::get('/concerns/config', 'config');
        Route::delete('{mission}', 'destroy');
        Route::post('{mission}/validate/{step}', 'validateMission');
        /**
         * Details
         */
        Route::prefix('details')->controller(MissionDetailController::class)->group(function () {
            Route::get('{detail}', 'show');
            Route::get('/concerns/config', 'config');
            Route::post('/{mission}', 'store');
        });
        /**
         * Report
         */
        Route::prefix('reports')->controller(MissionReportController::class)->group(function () {
            Route::post('/{mission}', 'store');
            Route::put('/{mission}', 'validateReport');
        });
        // Route::get('/missions_state', 'missions_state');
        // Route::put('/{mission}/validate', 'confirm');
        // Route::get('/{mission}/samples', 'samples');
        // Route::get('/validated', 'confirmed');
        // Route::get('/not-validated', 'notValidated');
        // Route::get('/{mission}/sample/{sample}', 'sampleDetails');
        // Route::get('/campaign/{campaign}', 'campaign');
    });

    /**
     * Details
     */
    Route::prefix('details')->controller(MissionDetailController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/major-facts', 'majorFacts');
        Route::get('/concerns/filters', 'filtersData');
    });
    Route::prefix('regularize')->controller(RegularizationController::class)->group(function () {
        Route::post('/{detail}', 'store');
    });
    /**
     * Dre -> agencies
     */
    Route::prefix('dre')->controller(DreController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{dre}', 'show');
        Route::post('/', 'store');
        Route::put('{dre}', 'update');
        Route::delete('{dre}', 'destroy');
    });
    Route::prefix('agencies')->controller(AgencyController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{agency}', 'show');
        Route::get('concerns/config', 'config');
        Route::post('/', 'store');
        Route::put('{agency}', 'update');
        Route::delete('{agency}', 'destroy');
    });
    Route::prefix('categories')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{category}', 'show');
        Route::get('concerns/config', 'config');
        Route::post('/', 'store');
        Route::put('{category}', 'update');
        Route::delete('{category}', 'destroy');
    });
    Route::prefix('upload')->controller(MediaController::class)->group(function () {
        Route::post('/', 'store');
        Route::delete('{media}', 'destroy');
        Route::get('/', 'index');
    });

    /**
     * Data for charts
     */
    Route::prefix('statistics')->controller(DataController::class)->group(function () {
        // Route::get('/dashboard', 'dashboard');
        Route::get('/anomalies', 'anomalies');
        Route::get('/majorFacts', 'majorFacts');
        Route::get('/scores', 'scores');
        Route::get('/realisationStates', 'realisationStates');
    });

    Route::prefix('notifications')->controller(NotificationController::class)->group(function () {
        Route::get('/', 'index');
        Route::put('/', 'update');
        // Route::get('total-unread-major-facts', 'total_unread_major_facts');
        Route::get('unreadNotifications', 'unreadNotifications');
        Route::post('read-major-facts', 'read_major_facts');
        Route::post('major-fact/{majorFact}', 'dispatchMajorFact');
    });
});

// Auth
Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);

    // Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    // Route::post('password/reset', [ResetPasswordController::class, 'reset']);
});
