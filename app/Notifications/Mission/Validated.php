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

        $content = 'Mission <b>' . $this->mission->reference . '</b> a été réalisé';
        switch ($this->type) {
            case 'ci_report':
                $content = 'La mission <b>' . $this->mission->reference . '</b> a été réalisée et validée par le <b>Contrôleur itinérant ' . auth()->user()->full_name . '</b>';
                break;
            case 'cdc_report':
                $content = 'La mission <b>' . $this->mission->reference . '</b> a été vérifiée et validée par le <b>Chef de Département Contrôle DRE ' . auth()->user()->full_name . '</b>';
                break;
            case 'cc':
                $content = 'La mission <b>' . $this->mission->reference . '</b> a été vérifiée et validée par le <b>Contrôleur central ' . auth()->user()->full_name . '</b>';
                break;
            case 'cdc':
                $content = 'La mission <b>' . $this->mission->reference . '</b> a été vérifiée et validée par le <b>Chef de Département de Contrôle Réseau ' . auth()->user()->full_name . '</b>';
                break;
            case 'dcp':
                $content = 'La mission <b>' . $this->mission->reference . '</b> a été vérifiée et validée par le <b>Directeur du Contrôle Permanent ' . auth()->user()->full_name . '</b>';
                break;
            case 'da':
                $content = 'La mission <b>' . $this->mission->reference . '</b> a été vérifiée et validée par le <b>Directeur d\'agence ' . auth()->user()->full_name . '</b>';
                break;
            default:
                $content = 'La mission <b>' . $this->mission->reference . '</b> a été vérifiée et validée par ' . auth()->user()->full_name . '</b>';
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
        if ($this->type == 'ci_report') {
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
