<?php

use App\Http\Controllers\Api\AgencyLevel\ControlCampaignController;
use App\Http\Controllers\Api\AgencyLevel\StatisticController;
use App\Http\Controllers\Api\AgencyLevel\Mission\AnomalyController;
use App\Http\Controllers\Api\AgencyLevel\Mission\MajorFactController;
use App\Http\Controllers\Api\AgencyLevel\Mission\MissionAssignationController;
use App\Http\Controllers\Api\AgencyLevel\Mission\MissionController;
use App\Http\Controllers\Api\AgencyLevel\Mission\MissionDetailController;
use App\Http\Controllers\Api\AgencyLevel\Mission\MissionCommentController;
use App\Http\Controllers\Api\AgencyLevel\Mission\MissionDetailRegularizationController;
use App\Http\Controllers\Api\AgencyLevel\Mission\MissionProcessController;
use App\Http\Controllers\Api\AgencyLevel\MissionStateController;
use App\Http\Controllers\Api\AgencyLevel\Statistics\KPIController;

use Illuminate\Support\Facades\Route;

Route::prefix('agency_level')->group(function () {


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
        Route::get('/processes/{campaign}/{process?}', 'processes');
        Route::put('/{campaign}', 'update');
        Route::put('/{campaign}/validate', 'validateCampaign');
        Route::delete('{campaign}', 'destroy');
        Route::delete('{campaign}/process/{process}', 'destroyProcess');
    });

    /**
     * Missions
     */
    Route::prefix('missions')->controller(MissionController::class)->group(function () {
        Route::get('/', 'index');
        Route::get('/{mission}', 'show');
        Route::get('/concerns/config', 'config');
        Route::get('anomalies/states', [MissionStateController::class, 'index']);
        Route::get('{mission}/processes', [MissionProcessController::class, 'index']);
        Route::get('control-points/{mission}/processes/{process}/', [MissionProcessController::class, 'controlPoints']);
        Route::post('/', 'store');
        Route::post('{mission}/additional-anomaly/{process}', [MissionProcessController::class, 'storeAdditionalAnomaly']);
        Route::post('/{mission}/report/{action?}', 'handleReport');
        Route::put('{mission}', 'update');
        Route::put('{mission}/validate/{type}', 'validateMission');
        Route::delete('{mission}', 'destroy');

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
            Route::put('{detail}', 'toggleState');
            Route::put('{detail}/{controlled}', 'toggleControlState');
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
        Route::get('{campaign?}/{mission?}', 'index');
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
        Route::post('{regularization}/comment', 'comment');
        Route::get('{detail}/history', 'show');
    });


    /**
     * Statistics
     */
    Route::prefix('statistics')->controller(StatisticController::class)->group(function () {
        Route::get('current-campaign', 'currentCampaign');
        Route::get('anomalies', 'anomalies');
        Route::get('major-facts', 'majorFacts');
        Route::get('scores', 'scores');
        Route::get('missions-states', 'missionsStates');
        Route::get('{campaign}/dre-statistics/{dre}', 'dre');
        Route::prefix('kpi')->controller(KPIController::class)->group(function () {
            Route::get('/', 'v1');
            Route::get('export/excel/{type}', 'exportToExcel');
        });
    });
});
