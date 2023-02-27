<?php

namespace App\Notifications;

use App\Models\MissionDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MissionDetailRegularized extends Notification
{
    use Queueable;

    /**
     * @var App\Models\MissionDetail
     */
    private $detail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(MissionDetail $detail)
    {
        $this->detail = $detail;
    }

    /**
     * Get email body
     *
     * @return string
     */
    private function getContent(): string
    {
        $content = "La mission avec la référence " . $this->detail->mission->reference . " qui concerne l'agence " . $this->detail->mission->agency->full_name . " vous a été assigné.";
        return $content;
    }

    /**
     * Get email subject
     *
     * @return string
     */
    private function getSubject(): string
    {
        return 'Mission assignée';
    }

    /**
     * Get action url
     *
     * @return string
     */
    private function getUrl(): string
    {
        return url('/missions/' . $this->detail->mission->id);
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
        // return ['database'];
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
            ->subject($this->getSubject())
            ->line($this->getContent())
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
            'id' => $this->detail->mission->id,
            'url' => $this->getUrl(),
            'content' => $this->getContent(),
            'title' => $this->getSubject(),
        ];
    }
}
