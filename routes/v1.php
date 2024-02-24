<?php

use App\Http\Controllers\API\EnvController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\StatisticController;
use App\Http\Controllers\Api\V1\AgencyController;
use App\Http\Controllers\Api\V1\Mission\AnomalyController;
use App\Http\Controllers\Api\V1\BackupController;
use App\Http\Controllers\Api\V1\BugController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\CommentController;
use App\Http\Controllers\Api\V1\ControlCampaignController;
use App\Http\Controllers\Api\V1\ControlPointController;
use App\Http\Controllers\Api\V1\DomainController;
use App\Http\Controllers\Api\V1\DreController;
use App\Http\Controllers\Api\V1\FamilyController;
use App\Http\Controllers\Api\V1\FieldController;
use App\Http\Controllers\Api\V1\Mission\MajorFactController;
use App\Http\Controllers\Api\V1\MediaController;
use App\Http\Controllers\Api\V1\Mission\MissionAssignationController;
use App\Http\Controllers\Api\V1\Mission\MissionController;
use App\Http\Controllers\Api\V1\Mission\MissionDetailController;
use App\Http\Controllers\Api\V1\Mission\MissionCommentController;
use App\Http\Controllers\Api\V1\NotificationController;
use App\Http\Controllers\Api\V1\ProcessController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\Settings\PasswordController;
use App\Http\Controllers\Api\V1\ReferenceController;
use App\Http\Controllers\Api\V1\Mission\MissionDetailRegularizationController;
use App\Http\Controllers\Api\V1\Mission\MissionProcessController;
use App\Http\Controllers\Api\V1\ModuleController;
use App\Http\Controllers\Api\V1\NotificationSettingController;
use App\Http\Controllers\Api\V1\Settings\SettingController;
use App\Http\Controllers\Api\V1\Statistics\KPIController;
use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\API\V1\PCFController;

Route::group(['middleware' => 'auth:api', 'prefix' => 'v1'], function () {
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
         * Control campaigns
         */
        Route::prefix('campaigns')->controller(ControlCampaignController::class)->group(function () {
            Route::get('/', 'index');
            Route::post('/', 'store');
            Route::post('/{campaign}/reports', 'generateReports');
            Route::get('/campaign', 'campaign');
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
            Route::put('{mission}', 'update');
            Route::get('/', 'index');
            Route::get('/{mission}', 'show');
            Route::get('/{mission}/report', 'handleReport');
            // Route::put('{mission}/assign', 'assignToCC');
            Route::get('/concerns/test-config', 'testConfig');
            Route::get('/concerns/config', 'config');
            Route::delete('{mission}', 'destroy');
            Route::put('{mission}/validate/{type}', 'validateMission');
            Route::get('{mission}/processes', [MissionProcessController::class, 'index']);

            /**
             * Processes
             */
            Route::prefix('{mission}/processes')->controller(MissionProcessController::class)->group(function () {
                Route::get('{process}', 'show');
                Route::put('{process}/lock', 'lock');
                Route::put('{process}/unlock', 'unlock');
            });

            /**
             * Details
             */
            Route::prefix('details')->controller(MissionDetailController::class)->group(function () {
                Route::get('{mission}/export', 'export');
                Route::get('{detail}', 'show');
                Route::post('{mission}', 'control');
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
         * Anomalies
         */
        Route::prefix('anomalies')->controller(AnomalyController::class)->group(function () {
            Route::get('/{mission?}', 'index');
        });

        /**
         * Major facts
         */
        Route::prefix('major-facts')->controller(MajorFactController::class)->group(function () {
            Route::get('/', 'index');
            Route::put('{detail}', 'reject');
            Route::post('{detail}', 'notify');
        });

        /**
         * Regularizations
         */
        Route::prefix('regularize')->controller(MissionDetailRegularizationController::class)->group(function () {
            Route::post('{detail}', 'store');
            Route::put('{regularization}/reject', 'reject');
            Route::put('{regularization}/accept', 'accept');
            // Route::put('{regularization}/der-comment', 'derComment');
            Route::get('{detail}/history', 'show');
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
        Route::prefix('categories')->controller(CategoryController::class)->group(function () {
            Route::get('/', 'index');
            Route::get('{category}', 'show');
            Route::get('concerns/config', 'config');
            Route::post('/', 'store');
            Route::put('{category}', 'update');
            Route::delete('{category}', 'destroy');
        });

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
         * Statistics
         */
        Route::prefix('statistics')->controller(StatisticController::class)->group(function () {
            Route::get('anomalies', 'anomalies');
            Route::get('major-facts', 'majorFacts');
            Route::get('scores', 'scores');
            Route::get('missions-states', 'missionsStates');
            Route::prefix('kpi')->controller(KPIController::class)->group(function () {
                Route::get('v1', 'v1');
                Route::get('export/excel/{type}', 'exportToExcel');
            });
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
