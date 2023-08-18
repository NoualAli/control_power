<?php

use App\Http\Controllers\Api\DataController;
use App\Http\Controllers\Api\AgencyController;
use App\Http\Controllers\Api\BugController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ControlCampaignController;
use App\Http\Controllers\Api\ControlPointController;
use App\Http\Controllers\Api\DomainController;
use App\Http\Controllers\Api\DreController;
use App\Http\Controllers\Api\FamilyController;
use App\Http\Controllers\Api\MajorFactController;
use App\Http\Controllers\Api\MediaController;
use App\Http\Controllers\Api\MissionAssignationController;
use App\Http\Controllers\Api\MissionController;
use App\Http\Controllers\Api\MissionDetailController;
use App\Http\Controllers\Api\MissionCommentController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\ProcessController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\Settings\PasswordController;
use App\Http\Controllers\Api\Settings\ProfileController;
use App\Http\Controllers\Api\ReferenceController;
use App\Http\Controllers\Api\MissionDetailRegularizationController;
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
        Route::get('/pcf/{controlPoint}', [ReferenceController::class, 'show']);
    });

    /**
     * Famillies -> Domains -> Processes -> Control Points
     */
    Route::prefix('families')->controller(FamilyController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('{family}', 'show');
        Route::post('/', 'store');
        Route::put('{family}', 'update');
        Route::delete('{family}', 'destroy');
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
        Route::get('/{mission}/report', 'handleReport');
        Route::get('/{mission}/report/check-if-is-generated', 'missionReportIsGenerated');
        Route::get('/{mission}/processes', 'processes');
        Route::put('{mission}', 'update');
        // Route::put('{mission}/assign', 'assignToCC');
        Route::get('/concerns/config', 'config');
        Route::delete('{mission}', 'destroy');
        Route::put('{mission}/validate/{type}', 'validateMission');
        Route::get('/{mission}/details/{process}', 'details');
        /**
         * Details
         */
        Route::prefix('details')->controller(MissionDetailController::class)->group(function () {
            Route::get('{detail}', 'show');
            Route::post('/{mission}', 'control');
        });

        /**
         * Mission assignation
         */

        Route::get('{mission}/assigned-processes/{user}', [MissionAssignationController::class, 'getAssignedProcesses']);
        Route::get('{mission}/loadAssignationData/{type}', [MissionAssignationController::class, 'loadAssignationData']);
        Route::get('{mission}/not-dispatched-processes/{type}', [MissionAssignationController::class, 'getNotDispatchedProcesses']);
        Route::post('{mission}/assign/{type}', [MissionAssignationController::class, 'assign']);
        Route::delete('{mission}/assign/{process}/{user}/{type}', [MissionAssignationController::class, 'destroy']);
    });


    /**
     * Mission Comments
     */
    Route::prefix('missions/{mission}/comments')->controller(MissionCommentController::class)->group(function () {
        Route::post('/', 'store');
    });
    /**
     * Details
     */
    Route::prefix('details')->controller(MissionDetailController::class)->group(function () {
        Route::get('/', 'index');
        // Route::get('/major-facts', 'majorFacts');
        Route::prefix('major-facts')->controller(MajorFactController::class)->group(function () {
            Route::get('/', 'index');
        });
    });
    Route::prefix('regularize')->controller(MissionDetailRegularizationController::class)->group(function () {
        Route::post('{detail}', 'store');
        Route::get('{detail}/history', 'show');
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

    Route::prefix('bugs')->controller(BugController::class)->group(function () {
        Route::get('/', 'index');
        Route::post('/', 'store');
        Route::get('{bug}', 'show');
    });

    Route::prefix('comments')->controller(CommentController::class)->group(function () {
        Route::get('{comment}', 'show');
    });
});

// Auth
Route::group(['middleware' => 'guest:api'], function () {
    Route::post('login', [LoginController::class, 'login']);

    // Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
    // Route::post('password/reset', [ResetPasswordController::class, 'reset']);
});
