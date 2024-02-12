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
     * @var int|\App\Models\ControlCampaign
     */
    private $campaign;

    /**
     * Create a new notification instance.
     * @param string|\App\Models\ControlCampaign
     *
     * @return void
     */
    public function __construct(string|ControlCampaign $campaign)
    {
        $this->campaign = is_string($campaign) ? ControlCampaign::findOrFail($campaign) : $campaign;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        $channels = collect([]);
        $setting = $notifiable->notification_settings()->whereRelation('type', 'code', 'control_campaign_created')->first();
        if ($setting?->database_is_enabled) {
            $channels->push('database');
        }

        if ($setting?->email_is_enabled && !config('mail.disabled')) {
            $channels->push('mail');
        }
        return $channels->toArray();
    }

    /**
     * Get action url
     *
     * @return string
     */
    private function getUrl(): string
    {
        return url('/campaigns/' . $this->campaign->id);
    }

    /**
     * Get Email / Notification title (subject)
     *
     * @return string
     */
    private function getTitle($notifiable): string
    {
        return  hasRole('cdcr', $notifiable) && $this->campaign?->validated_at ? 'VALIDATION DE LA CAMPAGNE DE CONTRÔLE ' . $this->campaign->reference . ' - ' . env('APP_NAME') : 'PLANIFICATION D\'UNE NOUVELLE CAMPAGNE DE CONTRÔLE ' . $this->campaign->reference . ' - ' . env('APP_NAME');
    }

    /**
     * Get Email / Notification content
     *
     * @return string
     */
    private function getHtmlContent($notifiable): string
    {
        return hasRole('cdcr', $notifiable) && $this->campaign?->validated_at ? '<p>Nous vous informons que la campagne de contrôle avec la référence <b>' . $this->campaign->reference . '</b> vient d\'être validé.</p>' : '<p>Nous vous informons qu\'une nouvelle campagne de contrôle avec la référence <b>' . $this->campaign->reference . '</b> vient d\'être planifiée.</p>';
    }

    /**
     * Get Email / Notification content
     *
     * @return string
     */
    private function getContent($notifiable): string
    {
        return hasRole('cdcr', $notifiable) && $this->campaign?->validated_at ? 'Nous vous informons que la campagne de contrôle avec la référence ' . $this->campaign->reference . ' vient d\'être validé' : 'Nous vous informons qu\'une nouvelle campagne de contrôle avec la référence ' . $this->campaign->reference . ' vient d\'être planifiée';
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
        $startingLine = 'La campagne débutera le ' . $this->campaign->start_date . ' dans exactement ' . $this->campaign->remaining_days_before_start . $startingSuffix;
        $endingLine = ' et se terminera le ' . $this->campaign->end_date . ' dans exactement ' . $this->campaign->remaining_days_before_end . $endingSuffix;
        $startingLine .= $endingLine;

        return (new MailMessage)
            ->subject($this->getTitle($notifiable))
            ->line($this->getContent($notifiable))
            ->line($startingLine)
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
            'content' => $this->getContent($notifiable),
            'short_content' => $this->getHtmlContent($notifiable),
            'title' => $this->getTitle($notifiable),
            'emitted_by' => auth()->user()->username,
        ];
    }
}