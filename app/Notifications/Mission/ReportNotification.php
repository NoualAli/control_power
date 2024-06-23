<?php

namespace App\Notifications\Mission;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class ReportNotification extends Notification
{
    use Queueable;


    /**
     * @var \App\Models\Mission
     */
    private $mission;

    /**
     * Create a new notification instance.
     *
     * @param \App\Models\Mission
     *
     * @return void
     */
    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }

    /**
     * Get email content
     *
     * @return string
     */
    private function getHtmlContent(): string
    {
        return '<p>Nous vous informons la mission <b>' . $this->mission->reference . '</b> a été validée.</p>';
    }

    /**
     * Get notification content
     *
     * @return string
     */
    private function getContent(): string
    {
        return 'Nous vous informons que la mission ' . $this->mission->reference . ' a été validée.';
    }

    /**
     * Get email subjet
     * @return string
     */
    private function getSubject(): string
    {
        return 'MISSION ' . $this->mission->reference . ' VALIDEE - ' . env('APP_NAME');
    }

    /**
     * Get notification title
     *
     * @return string
     */
    private function getTitle(): string
    {
        return 'MISSION ' . $this->mission->reference . ' VALIDEE';
    }

    /**
     * Get action url
     *
     * @return string
     */
    private function getUrl(): string
    {
        return url('/agency-level/missions/' . $this->mission->id);
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
        $setting = $notifiable->notification_settings()->whereRelation('type', 'code', 'mission_pdf_repport_generated')->first();
        if ($setting?->database_is_enabled) {
            $channels->push('database');
        }

        if ($setting?->email_is_enabled && !config('mail.disabled')) {
            $channels->push('mail');
        }
        return $channels->toArray();
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // $file = Storage::path('public\exported\campaigns\\' . $this->mission->campaign->reference . '\\missions\\' . $this->mission->report_name . '.pdf');
        return (new MailMessage)
            ->subject($this->getSubject())
            ->line($this->getContent())
            ->line('Pour plus de détails veuillez cliquer sur le lien ci-dessous')
            ->action('Voir la mission', $this->getUrl())
            ->line('Merci d\'utiliser ControlPower!')
            ->success();
        // ->attach($file, [
        //     'as' => '',
        //     'mime' => 'application/pdf'
        // ]);
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
            'short_content' => $this->getHtmlContent(),
            'title' => $this->getTitle(),
            'subject' => $this->getSubject(),
            'emitted_by' => 'Système',
        ];
    }
}
