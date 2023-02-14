<?php

namespace App\Notifications;

use App\Models\Mission;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MissionCreatedNotification extends Notification
{
    use Queueable;

    /**
     * @var App\Models\Mission
     */
    private $mission;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }

    /**
     * Get email body
     *
     * @return string
     */
    private function getContent(): string
    {
        $content = "Une nouvelle mission avec la référence " . $this->mission->reference . " pour l'agence " . $this->mission->agency->full_name . " vous a été assigné.";
        return $content;
    }

    /**
     * Get email subject
     *
     * @return string
     */
    private function getSubject(): string
    {
        return 'Assignation de mission';
    }

    /**
     * Get action url
     *
     * @return string
     */
    private function getUrl(): string
    {
        return url('/missions/' . $this->mission->id);
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
        $startLine = "\n\rLa mission commence le " . $this->mission->start;
        $endLine = "\n\rLa mission se termine le " . $this->mission->end;
        return (new MailMessage)
            ->subject($this->getSubject())
            ->line($this->getContent())
            ->line($startLine)
            ->line($endLine)
            ->action('Voir la mission', $this->getUrl())
            ->line('Merci d\'utiliser notre application');
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
            'url' => $this->getUrl(),
            'content' => $this->getContent(),
            'title' => $this->getSubject(),
        ];
    }
}
