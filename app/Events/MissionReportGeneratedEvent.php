<?php

namespace App\Events;

use App\Models\Mission;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MissionReportGeneratedEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $mission;
    private $user;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    // public function __construct(Mission $mission)
    // {
    //     $this->mission = $mission;
    // }
    public function __construct(Mission $mission, User $user)
    {
        $this->mission = $mission;
        $this->user = $user;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        $missions = $this->missions()->where('campagin_id', '!=', 1)?->pluck('id')->toArray() ?: [];
        $check = hasRole(['cdcr', 'dcp', 'cdrcp']) || in_array($this->mission->id, $missions);

        if ($check) {
            return new Channel('mission.report.generated.' . $this->user->id);
        }
        // return new PrivateChannel('mission.report.generated.' . $this->mission->id);
        // return new PrivateChannel('mission.report.generated.' . $this->user->id);
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs()
    {
        return 'MissionReportGenerated';
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastWith()
    {
        return [
            'title' => 'Mission ' . $this->mission->reference,
            'message' => 'Nous vous informons que le rapport PDF de la mission <b>' . $this->mission->reference . '</b> est maintenant disponible.',
            'link' => env('APP_URL') . '/missions/' . $this->mission->id
        ];
    }
}
