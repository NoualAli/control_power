<?php

namespace App\Notifications;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReportNotification extends Notification
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
        return 'Nous vous informons que le rapport PDF de la mission <b>' . $this->mission->reference . '</b> est maintenant disponible.';
    }

    /**
     * Get email subject
     *
     * @return string
     */
    private function getTitle(): string
    {
        return 'Rapport PDF mission ' . $this->mission->reference . ' disponible';
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
        if (app()->environment('production')) {
            return ['mail', 'database'];
        }
        return ['database'];
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
            ->subject($this->getTitle())
            ->line($this->getContent())
            ->line('Pour plus de détails veuillez cliquer sur le lien ci-dessous')
            ->action('Voir la mission', $this->getUrl())
            ->line('Merci d\'utiliser PowerControl!')
            ->success();
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
            'title' => $this->getTitle(),
            'emitted_by' => 'système',
        ];
    }
}
