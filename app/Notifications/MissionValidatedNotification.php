<?php

namespace App\Notifications;

use App\Models\Mission;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MissionValidatedNotification extends Notification
{
    use Queueable;

    /**
     * @var App\Models\User
     */
    private $user;

    /**
     * @var App\Models\Mission
     */
    private $mission;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $title;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Mission $mission, User $user)
    {
        $this->user = $user;
        $this->mission = $mission;
        $this->content = 'La mission de contrôle ' . $this->mission->reference . ' vient d\'être validée';
        $this->title = 'Mission validée';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject($this->title)
            ->line($this->content)
            ->line('Pour plus de détails veuillez cliquer sur le lien ci-dessous')
            ->action('Voir la mission', env('APP_URL') . '/missions/' . $this->mission->id)
            ->line('Merci d\'utiliser notre application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->mission->id,
            'className' =>  'App\Models\Mission',
            'routeName' => 'mission',
            'paramNames' => 'missionId',
            'content' => $this->content,
            'title' => $this->title,
        ];
    }
}
