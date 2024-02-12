<?php

namespace App\Notifications;

use App\Models\MissionDetailRegularization;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MissionDetailRegularizationRejected extends Notification
{
    /**
     * @var \App\Models\MissionDetailRegularization
     */
    private $regularization;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\MissionDetailRegularization
     *
     * @return void
     */
    public function __construct(MissionDetailRegularization $regularization)
    {
        $this->regularization = $regularization;
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
        $setting = $notifiable->notification_settings()->whereRelation('type', 'code', 'mission_detail_regularization_rejected')->first();
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
        return url('/anomalies?filter[id]=' . $this->regularization->detail->id);
    }

    /**
     * Get Email / Notification title (subject)
     *
     * @return string
     */
    private function getTitle(): string
    {
        return 'REGULARISATION REJETER - ' . $this->regularization?->detail?->mission?->reference . ' - ' . env('APP_NAME');
    }

    /**
     * Get Email body
     *
     * @return string
     */
    private function getContent(): string
    {
        return 'Une régularisation vient d\'être rejeté dans la mission ' . $this->regularization?->detail?->mission?->reference;
    }

    /**
     * Get Notification content
     *
     * @return string
     */
    private function getHtmlContent(): string
    {
        return '<p>Une régularisation vient d\'être rejeté dans la mission <b>' . $this->regularization?->detail?->mission?->reference . '</b></p>';
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
            ->action('Voir plus', $this->getUrl())
            ->line('Merci d\'utiliser ControlPower!');
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
            'id' => $this->regularization?->detail?->id,
            'url' => $this->getUrl(),
            'content' => $this->getContent(),
            'short_content' => $this->getHtmlContent(),
            'title' => $this->getTitle(),
            'emitted_by' => auth()->user()->username,
        ];
    }
}