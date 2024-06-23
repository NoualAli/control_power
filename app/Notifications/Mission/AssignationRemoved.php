<?php

namespace App\Notifications\Mission;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AssignationRemoved extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\Mission
     */
    private $mission;

    /**
     * Create a new notification instance.
     *
     * @param string|\App\Models\Mission $mission
     *
     * @return void
     */
    public function __construct(string|Mission $mission)
    {
        $this->mission = is_string($mission) ? Mission::findOrFail($mission) : $mission;
    }

    /**
     * Get email body
     *
     * @return string
     */
    private function getContent(): string
    {
        $content = "La mission avec la référence " . $this->mission->reference . " pour l'agence " . $this->mission->agency->full_name . " vous a été retirer.";
        return $content;
    }

    /**
     * Get email subject
     *
     * @return string
     */
    private function getTitle(): string
    {
        return 'REVOCATION DE LA MISSION ' . $this->mission->reference . ' - ' . env('APP_NAME');
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
        $setting = $notifiable->notification_settings()->whereRelation('type', 'code', 'mission_assignation_removed')->first();
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
        return (new MailMessage)
            ->subject($this->getTitle())
            ->line($this->getContent())
            ->action('Voir la mission', $this->getUrl())
            ->line('Merci d\'utiliser ControlPower')
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
            'emitted_by' => auth()->user()->username,
        ];
    }
}
