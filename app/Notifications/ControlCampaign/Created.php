<?php

namespace App\Notifications\ControlCampaign;

use App\Models\ControlCampaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Created extends Notification
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
    private function getTitle($notifiable): string
    {
        return  hasRole('cdcr', $notifiable) && $this->campaign?->validated_at ? 'Validation de la campagne de contrôle ' . $this->campaign->reference : 'Création d\'une nouvelle campagne de contrôle ' . $this->campaign->reference;
    }

    /**
     * Get Email / Notification content
     *
     * @return string
     */
    private function getContent($notifiable): string
    {
        return hasRole('cdcr', $notifiable) && $this->campaign?->validated_at ? 'Nous vous informons que la campagne de contrôle avec la référence ' . $this->campaign->reference . ' vient d\'être validé' : 'Nous vous informons qu\'une nouvelle campagne de contrôle avec la référence ' . $this->campaign->reference . ' vient d\'être créer';
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $startingSuffix = $this->campaign->remaining_days_before_start > 1 ? ' jours' : ' jour';
        $endingSuffix = $this->campaign->remaining_days_before_end > 1 ? ' jours' : ' jour';
        $startingLine = 'La campagne débutera le ' . $this->campaign->start . ' dans exactement ' . $this->campaign->remaining_days_before_start . $startingSuffix;
        $endingLine = 'La campagne se terminera le ' . $this->campaign->end . ' dans exactement ' . $this->campaign->remaining_days_before_end . $endingSuffix;

        return (new MailMessage)
            ->subject($this->getTitle($notifiable))
            ->line($this->getContent($notifiable))
            ->line($startingLine)
            ->line($endingLine)
            ->line('Pour plus de détails veuillez cliquer sur le lien ci-dessous')
            ->action('Voir la campagne de contrôle', $this->getUrl())
            ->line('Merci d\'utiliser notre application!')
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
            'content' => $this->getContent($notifiable),
            'title' => $this->getTitle($notifiable),
            'emitted_by' => auth()->user()->full_name
        ];
    }
}
