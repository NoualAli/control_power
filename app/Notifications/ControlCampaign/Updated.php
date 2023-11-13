<?php

namespace App\Notifications\ControlCampaign;

use App\Models\ControlCampaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Updated extends Notification
{
    use Queueable;

    /**
     * @var App\Models\ControlCampaign
     */
    private $campaign;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ControlCampaign $campaign)
    {
        $this->campaign = $campaign;
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
     * Get action url
     *
     * @return string
     */
    private function getUrl(): string
    {
        return url('/campaigns/' . $this->campaign->id);
        // return url('/campaigns/' . $this->campaign->id);
    }

    /**
     * Get Email / Notification title (subject)
     *
     * @return string
     */
    private function getTitle(): string
    {
        return 'Mise à jour de la campagne de contrôle ' . $this->campaign->reference;
    }

    /**
     * Get Email / Notification content
     *
     * @return string
     */
    private function getContent(): string
    {
        return 'Des modifications ont étaient apportés à la campagne de contrôle avec la référence ' . $this->campaign->reference;
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
            ->action('Voir la campagne de contrôle', $this->getUrl())
            ->line('Merci d\'utiliser ControlPower!')
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
            'id' => $this->campaign->id,
            'url' => $this->getUrl(),
            'content' => $this->getContent(),
            'title' => $this->getTitle(),
        ];
    }
}
