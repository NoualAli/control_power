<?php

namespace App\Notifications\Mission;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Validated extends Notification
{
    use Queueable;

    /**
     * @var App\Models\Mission
     */
    private $mission;

    /**
     * @var string
     */
    private $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Mission $mission, $type)
    {
        $this->mission = $mission;
        $this->type = $type;
    }

    /**
     * Get email body
     *
     * @return string
     */
    private function getContent(): string
    {

        $content = 'Mission ' . $this->mission->reference . ' a été réalisé';
        switch ($this->type) {
            case 'ci_opinion':
                $content = 'La mission ' . $this->mission->reference . ' a été réalisée et validée par le Contrôleur itinérant' . auth()->user()->full_name;
                break;
            case 'cdc_report':
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par le Chef de Département Contrôle DRE ' . auth()->user()->full_name;
                break;
            case 'cc':
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par le Collaborateur ' . auth()->user()->full_name;
                break;
            case 'cdc':
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par le Chef de Département de Contrôle Réseau ' . auth()->user()->full_name;
                break;
            case 'dcp':
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par le Directeur du Contrôle Permanent ' . auth()->user()->full_name;
                break;
            default:
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par ' . auth()->user()->full_name;
                break;
        }
        return $content;
    }

    /**
     * Get email subject
     *
     * @return string
     */
    private function getTitle(): string
    {
        if ($this->type == 'ci_opinion') {
            return 'Mission ' . $this->mission->reference . ' réalisée et validée par ' . auth()->user()->full_name;
        }
        return 'Mission ' . $this->mission->reference . ' vérifiée et validée par ' . auth()->user()->full_name;
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
        return (new MailMessage)
            ->subject($this->getTitle())
            ->line($this->getContent())
            ->line('Pour plus de détails veuillez cliquer sur le lien ci-dessous')
            ->action('Voir la mission', url('/missions/' . $this->mission->id))
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
            'id' => $this->mission->id,
            'url' => $this->getUrl(),
            'content' => $this->getContent(),
            'title' => $this->getTitle(),
            'emitted_by' => auth()->user()->full_name,
        ];
    }
}
