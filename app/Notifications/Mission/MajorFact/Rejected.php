<?php

namespace App\Notifications\Mission\MajorFact;

use App\Models\MissionDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Rejected extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\MissionDetail
     */
    private $detail;

    /**
     * Create a new notification instance.
     *
     * @param string|\App\Models\MissionDetail
     *
     * @return void
     */
    public function __construct(string|MissionDetail $detail)
    {
        $this->detail = is_string($detail) ? MissionDetail::findOrFail($detail) : $detail;
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
        $setting = $notifiable->notification_settings()->whereRelation('type', 'code', 'mission_major_fact_rejected')->first();
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
        return url('/agency-level/major-facts?filter[id]=' . $this->detail->id);
    }

    /**
     * Get Email / Notification title (subject)
     *
     * @return string
     */
    private function getTitle(): string
    {
        return 'FAIT MAJEUR REJETER - ' . $this->detail?->mission?->reference . ' - ' . env('APP_NAME');
    }

    /**
     * Get Email / Notification content
     *
     * @return string
     */
    private function getContent(): string
    {
        return 'Un fait majeur vient d\'être rejeté dans la mission ' . $this->detail->mission->reference;
    }
    /**
     * Get Notification content
     *
     * @return string
     */
    private function getHtmlContent(): string
    {
        return '<p>Un fait majeur vient d\'être rejeté dans la mission <b>' . $this->detail->mission->reference . '</b></p>';
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
            ->action('Voir le fait majeur', $this->getUrl())
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
            'id' => $this->detail->id,
            'url' => $this->getUrl(),
            'content' => $this->getContent(),
            'short_content' => $this->getHtmlContent(),
            'title' => $this->getTitle(),
            'emitted_by' => auth()->user()->username,
        ];
    }
}
