<?php

namespace App\Notifications\Mission;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Deleted extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\Mission
     */
    private $mission;

    /**
     * Create a new notification instance.
     *
     * @param int|\App\Models\Mission $mission
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
        $content = "La mission " . $this->mission->reference . " pour l'agence " . $this->mission->agency->full_name . " vient d'être annulée.";
        return $content;
    }

    /**
     * Get notification body
     *
     * @return string
     */
    private function getShortContent(): string
    {
        $content = "<p>La mission <b>" . $this->mission->reference . "</b> pour l'agence <b>" . $this->mission->agency->full_name . "</b> vient d'être annulée.</p>";
        return $content;
    }

    /**
     * Get email subject
     *
     * @return string
     */
    private function getTitle(): string
    {
        return 'ANNULATION DE LA MISSION ' . $this->mission->reference . ' - ' . env('APP_NAME');
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
        $setting = $notifiable->notification_settings()->whereRelation('type', 'code', 'mission_deleted')->first();
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
            'content' => $this->getContent(),
            'short_content' => $this->getShortContent(),
            'title' => $this->getTitle(),
            'emitted_by' => auth()->user()->username,
        ];
    }
}