<?php

namespace App\Notifications\Mission\Detail;

use App\Models\Mission;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MissionDetailAssigned extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\User
     */
    protected $controller;

    /**
     * @var \App\Models\Mission
     */
    protected $mission;

    /**
     * @param \App\Models\User $controller
     * @param \App\Models\Mission $mission
     * @param Collection $processes
     */
    public function __construct(User $controller, Mission $mission)
    {
        $this->controller = $controller;
        $this->mission = $mission;
    }

    /**
     * Get email body
     *
     * @return string
     */
    private function getContent(): string
    {
        $content = "La mission avec la référence {$this->mission->reference} vous a été assignée";

        return $content;
    }

    /**
     * Get notification body
     *
     * @return string
     */
    private function getHtmlContent(): string
    {
        $content = "La mission <b>" . $this->mission->reference . "</b> vous a été assignée.";

        return "<p>$content</p>";
    }

    /**
     * Get email subject
     *
     * @return string
     */
    private function getTitle(): string
    {
        return 'ASSIGNATION DE LA MISSION ' . $this->mission->reference;
        // $totalProcesses = is_array($this->processes) ? count($this->processes) : $this->processes->count();
        // return $totalProcesses > 1 ? 'ASSIGNATION DES PROCESSUS - ' . $this->mission->reference . ' - ' . env('APP_NAME') : 'ASSIGNATION D\'UN PROCESSUS - ' . $this->mission->reference . ' - ' . env('APP_NAME');
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
        $channels = collect([]);
        $setting = $notifiable->notification_settings()->whereRelation('type', 'code', 'mission_assigned')->first();
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
            ->greeting('Bonjour ' . $this->controller->full_name)
            ->line($this->getContent())
            ->line('Pour plus d\'informations veuillez vous rendre sur l\'application')
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
            'short_content' => $this->getHtmlContent(),
            'title' => $this->getTitle(),
            'emitted_by' => auth()->user()->username,
        ];
    }
}
