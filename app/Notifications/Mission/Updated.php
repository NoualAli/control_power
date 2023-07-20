<?php

namespace App\Notifications\Mission;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Updated extends Notification
{
    use Queueable;

    /**
     * @var App\Models\Mission
     */
    private $mission;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }

    /**
     * Get email body
     *
     * @return string
     */
    private function getContent(): string
    {
        $content = "La mission " . $this->mission->reference . " pour l'agence " . $this->mission->agency->full_name . " a été mise à jour.";
        return $content;
    }

    /**
     * Get email subject
     *
     * @return string
     */
    private function getTitle(): string
    {
        return 'Mise à jour: mission ' . $this->mission->reference;
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
        if (app()->environment('production')) {
            return ['mail', 'database'];
        }
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $startLine = "La mission commence le " . $this->mission->start;
        $endLine = "La mission se termine le " . $this->mission->end;
        return (new MailMessage)
            ->subject($this->getTitle())
            ->line($this->getContent())
            ->line($startLine)
            ->line($endLine)
            ->action('Voir la mission', $this->getUrl())
            ->line('Merci d\'utiliser PowerControl')
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
            'emitted_by' => auth()->user()->full_name,
        ];
    }
}
