<?php

namespace App\Providers;

use App\Models\ControlCampaign;
use App\Models\Mission;
use App\Models\MissionDetail;
use App\Observers\CampaignObserver;
use App\Observers\MissionDetailObserver;
use App\Observers\MissionObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        ControlCampaign::observe(CampaignObserver::class);
        Mission::observe(MissionObserver::class);
        MissionDetail::observe(MissionDetailObserver::class);
    }
}
