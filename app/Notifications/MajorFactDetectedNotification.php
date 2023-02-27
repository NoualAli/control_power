<?php

namespace App\Notifications;

use App\Models\MissionDetail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MajorFactDetectedNotification extends Notification
{
    use Queueable;

    private $detail;
    private $content;
    private $title;

    /**
     * Create a new notification instance.
     * @param App\Models\MissionDetail $detail
     * @return void
     */
    public function __construct(MissionDetail $detail)
    {
        $this->detail = $detail;
        $this->title = 'Fait majeur détecter';
        $this->content = 'Un fait majeur vient d\'être détecter dans la mission ' . $this->detail->mission->reference;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
        // return ['database'];
    }

    public function getUrl()
    {
        return url('/missions/' . $this->detail->mission->id . '/details/' . $this->detail->process->id);
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
            ->subject($this->title)
            ->line($this->content)
            ->line('Pour plus d\'informations veuillez cliquer sur le lien ci-dessous.')
            ->action('Voir le fait majeur', env('APP_URL') . '/major-facts?search=' . $this->detail->id)
            ->line('Merci d\'utiliser notre application!');
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
            'id' => $this->detail->mission->id,
            'url' => $this->getUrl(),
            'content' => $this->content,
            'title' => $this->title,
            'detail_id' => $this->detail->id,
        ];
    }
}
