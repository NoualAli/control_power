<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Storage;

class FileGeneratedNotification extends Notification
{
    use Queueable;

    /**
     * @var string
     */
    private $filepath;

    /**
     * @var string
     */
    private $filename;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(string $filepath, string $filename)
    {
        $this->filepath = $filepath;
        $this->filename = $filename;
    }

    /**
     * Get email content
     *
     * @return string
     */
    private function getHtmlContent(): string
    {
        return '<p>Nous vous informons que le fichier <b>' . $this->filename . '</b> est maintenant disponible.</p>';
    }

    /**
     * Get notification content
     *
     * @return string
     */
    private function getContent(): string
    {
        return 'Trouvez ci-joint le fichier ' . $this->filename . '.';
    }

    /**
     * Get email subjet
     * @return string
     */
    private function getSubject(): string
    {
        return $this->filename . ' - ' . env('APP_NAME');
    }

    /**
     * Get notification title
     *
     * @return string
     */
    private function getTitle(): string
    {
        return $this->filename . ' DISPONIBLE';
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $file = Storage::path($this->filepath);
        return (new MailMessage)
            ->subject($this->getSubject())
            ->line($this->getContent())
            ->line('Merci d\'utiliser ControlPower!')
            ->attach($file, [
                'as' => '',
                'mime' => 'application/pdf'
            ]);
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
            'content' => $this->getContent(),
            'short_content' => $this->getHtmlContent(),
            'title' => $this->getTitle(),
            'subject' => $this->getSubject(),
            'emitted_by' => 'Système',
        ];
    }
}
