<?php

use App\Broadcasting\MissionReportGeneratedChannel;
use App\Models\Mission;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });
// dd('ts');
// Broadcast::channel('private-default.mission.report.generated.{id}', function ($user, $id) {
//     // dd($user, $id);
//     // return true;
//     // print_r($user);
//     return (int) $user->id === (int) $id;
//     // return hasRole(['cdcr', 'dcp', 'dg', 'sg', 'cdrcp', $user]) || in_array($id, $user->missions()->pluck('id')->toArray());
// });

// Broadcast::channel('mission.report.generated.{mission}', MissionReportGeneratedChannel::class);
// Broadcast::channel('mission.report.generated.{user}', MissionReportGeneratedChannel::class);
Broadcast::channel('mission.report.generated', MissionReportGeneratedChannel::class);
