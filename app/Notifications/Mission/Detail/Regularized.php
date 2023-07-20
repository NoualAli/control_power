<?php

namespace App\Notifications\Mission\Detail;

use App\Models\MissionDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Regularized extends Notification
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
        if (app()->environment('production')) {
            return ['mail', 'database'];
        }
        return ['database'];
    }

    /**
     * Get action url
     *
     * @return string
     */
    private function getUrl(): string
    {
        return url('/details?search=' . $this->detail->id);
        // return url('/details/' . $this->detail->id);
    }

    /**
     * Get Email / Notification title (subject)
     *
     * @return string
     */
    private function getTitle(): string
    {
        return 'Anomalie levée';
    }

    /**
     * Get Email / Notification content
     *
     * @return string
     */
    private function getContent($toString = false): array|string
    {
        $content = [
            "L'anomalie concernant le point de contrôle " . $this->detail->controlPoint->name,
            "dans l'agence " . $this->detail->agency->full_name . " a été levée avec succès."
        ];
        if ($toString) {
            $content = implode(' ', $content);
        }
        return $content;
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
            ->lines($this->getContent(true))
            ->line('Pour plus de détails veuillez cliquer sur le lien ci-dessous')
            ->action('Voir le point de contrôle', $this->getUrl())
            ->line('Merci d\'utiliser PowerControl!')
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
            'id' => $this->detail->id,
            'url' => $this->getUrl(),
            'content' => $this->getContent(true),
            'title' => $this->getTitle(),
            'emitted_by' => auth()->user()->full_name,
        ];
    }
}
