<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BugDetected extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\Bug
     */
    protected $bug;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(\App\Models\Bug $bug)
    {
        $this->bug = $bug;
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
        $channels->push('database');

        if (!config('mail.disabled')) {
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
        return url('/bugs/');
    }

    /**
     * Get Email / Notification title (subject)
     *
     * @return string
     */
    private function getTitle($notifiable): string
    {
        return 'BUG SIGNALER - ' . $this->bug->reference . ' - ' . env('APP_NAME');
    }

    /**
     * Get Email / Notification content
     *
     * @return string
     */
    private function getHtmlContent($notifiable): string
    {
        return '<p>Nous vous informons qu\'un bug avec la référence <b>' . $this->bug->reference . '</b> de type <b>' . $this->bug->type . '</b> avec une priorité <b>' . $this->bug->priority_str . '</b> vient d\'être signalé.</p>';
    }

    /**
     * Get Email / Notification content
     *
     * @return string
     */
    private function getContent($notifiable): string
    {
        return 'Nous vous informons qu\'un bug avec la référence ' . $this->bug->reference . ' de type ' . $this->bug->type . ' avec une priorité ' . $this->bug->priority_str . ' vient d\'être signalé';
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
            ->subject($this->getTitle($notifiable))
            ->line($this->getContent($notifiable))
            ->line('Pour plus de détails veuillez cliquer sur le lien ci-dessous')
            ->action('Liste des bugs', $this->getUrl())
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
            'id' => $this->bug->id,
            'content' => $this->getContent($notifiable),
            'short_content' => $this->getHtmlContent($notifiable),
            'title' => $this->getTitle($notifiable),
            'emitted_by' => auth()->user()->username,
        ];
    }
}