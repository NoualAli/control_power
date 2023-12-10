<?php

namespace App\Notifications\ControlCampaign;

use App\Models\ControlCampaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Deleted extends Notification
{
    use Queueable;

    /**
     * @var int|\App\Models\ControlCampaign
     */
    private $campaign;

    /**
     * Create a new notification instance.
     * @param int|\App\Models\ControlCampaign
     *
     * @return void
     */
    public function __construct(int|ControlCampaign $campaign)
    {
        $this->campaign = is_integer($campaign) ? ControlCampaign::findOrFail($campaign) : $campaign;
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
     * Get Email / Notification title (subject)
     *
     * @return string
     */
    private function getTitle(): string
    {
        return  'Campagne de contrôle ' . $this->campaign->reference . ' annulée';
    }

    /**
     * Get Email / Notification content
     *
     * @return string
     */
    private function getContent(): string
    {
        return 'Nous vous faisons savoir que la campagne de contrôle sous la référence ' . $this->campaign->reference . ' a été annulée.';
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
            ->line('Merci d\'utiliser ControlPower!')
            ->error();
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
            'content' => $this->getContent(),
            'title' => $this->getTItle(),
        ];
    }
}
