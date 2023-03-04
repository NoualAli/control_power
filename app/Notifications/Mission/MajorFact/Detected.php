<?php

namespace App\Notifications\Mission\MajorFact;

use App\Models\MissionDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Detected extends Notification
{
    use Queueable;

    /**
     * @var App\Models\MissionDetail
     */
    private $detail;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(MissionDetail $detail)
    {
        $this->detail = $detail;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return !app()->environment('hostinger') ? ['mail', 'database'] : ['database'];
    }

    /**
     * Get action url
     *
     * @return string
     */
    private function getUrl(): string
    {
        return url('/major-facts?filter[id]=' . $this->detail->id);
    }

    /**
     * Get Email / Notification title (subject)
     *
     * @return string
     */
    private function getTitle(): string
    {
        return 'Fait majeur détecter';
    }

    /**
     * Get Email / Notification content
     *
     * @return string
     */
    private function getContent(): string
    {
        return 'Un fait majeur vient d\'être détecter dans la mission ' . $this->detail->mission->reference;
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
            ->line('Merci d\'utiliser notre application!')
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
            'title' => $this->getTitle(),
        ];
    }
}
