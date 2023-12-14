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
     * @var string
     */
    private $type;

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
    public function __construct(string|Mission $mission, $type)
    {
        $this->mission = is_string($mission) ? Mission::findOrFail($mission) : $mission;
        $this->type = $type;
    }

    /**
     * Get Email body
     *
     * @return string
     */
    private function getContent(): string
    {

        $content = 'Mission ' . $this->mission->reference . ' a été réalisé';
        switch ($this->type) {
            case 'ci_report':
                $content = 'La mission ' . $this->mission->reference . ' a été réalisée et validée par le Contrôleur itinérant ' . auth()->user()->full_name_with_martial;
                break;
            case 'ci':
                $content = 'La mission ' . $this->mission->reference . ' a été réalisée et validée par le Contrôleur itinérant ' . auth()->user()->full_name_with_martial;
                break;
            case 'cdc_report':
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par le Chef de Département Contrôle DRE ' . auth()->user()->full_name_with_martial;
                break;
            case 'cdc':
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par le Chef de Département Contrôle DRE ' . auth()->user()->full_name_with_martial;
                break;
            case 'cc':
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par le Contrôleur central ' . auth()->user()->full_name_with_martial;
                break;
            case 'cdcr':
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par le Chef de Département de Contrôle Réseau ' . auth()->user()->full_name_with_martial;
                break;
            case 'dcp':
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par le Directeur du Contrôle Permanent ' . auth()->user()->full_name_with_martial;
                break;
            case 'da':
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par le Directeur d\'agence ' . auth()->user()->full_name_with_martial;
                break;
            default:
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par ' . auth()->user()->full_name_with_martial;
                break;
        }
        return $content;
    }

    /**
     * Get short content
     *
     * @return string
     */
    private function getHtmlContent(): string
    {

        $content = 'Mission ' . $this->mission->reference . ' a été réalisé';
        switch ($this->type) {
            case 'ci_report':
                $content = 'La mission <b>' . $this->mission->reference . '</b> a été réalisée et validée par le <b>Contrôleur itinérant ' . auth()->user()->full_name_with_martial . '</b>';
                break;
            case 'ci':
                $content = 'La mission <b>' . $this->mission->reference . '</b> a été réalisée et validée par le <b>Contrôleur itinérant ' . auth()->user()->full_name_with_martial . '</b>';
                break;
            case 'cdc_report':
                $content = 'La mission <b>' . $this->mission->reference . '</b> a été vérifiée et validée par le <b>Chef de Département Contrôle DRE ' . auth()->user()->full_name_with_martial . '</b>';
                break;
            case 'cdc':
                $content = 'La mission <b>' . $this->mission->reference . '</b> a été vérifiée et validée par le <b>Chef de Département Contrôle DRE ' . auth()->user()->full_name_with_martial . '</b>';
                break;
            case 'cc':
                $content = 'La mission <b>' . $this->mission->reference . '</b> a été vérifiée et validée par le <b>Contrôleur central ' . auth()->user()->full_name_with_martial . '</b>';
                break;
            case 'cdcr':
                $content = 'La mission <b>' . $this->mission->reference . '</b> a été vérifiée et validée par le <b>Chef de Département de Contrôle Réseau ' . auth()->user()->full_name_with_martial . '</b>';
                break;
            case 'dcp':
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par le Directeur du Contrôle Permanent ' . auth()->user()->full_name_with_martial;
                break;
            case 'da':
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée, régularisée et validée par le Directeur d\'agence ' . auth()->user()->full_name_with_martial;
                break;
            default:
                $content = 'La mission ' . $this->mission->reference . ' a été vérifiée et validée par ' . auth()->user()->full_name_with_martial;
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
        if ($this->type == 'ci' || 'ci_report') {
            return 'Mission ' . $this->mission->reference . ' réalisée et validée par ' . auth()->user()->full_name_with_martial;
        }
        return 'Mission ' . $this->mission->reference . ' traitée et validée par ' . auth()->user()->full_name_with_martial;
    }

    private function getObject(): string
    {
        if ($this->type == 'ci' || 'ci_report') {
            return 'MISSION ' . $this->mission->reference . ' RÉALISÉE ET VALIDÉE PAR ' . auth()->user()->full_name_with_martial . ' - ' . env('APP_NAME');
        }
        return 'MISSION ' . $this->mission->reference . ' TRAITÉE ER VALIDÉE PAR ' . auth()->user()->full_name_with_martial . ' - ' . env('APP_NAME');
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
        if (!config('mail.disabled')) {
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
            ->subject($this->getObject())
            ->line($this->getContent())
            ->line('Pour plus de détails veuillez cliquer sur le lien ci-dessous')
            ->action('Voir la mission', url('/missions/' . $this->mission->id))
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
            'id' => $this->mission->id,
            'url' => $this->getUrl(),
            'content' => $this->getContent(),
            'short_content' => $this->getHtmlContent(),
            'subject' => $this->getObject(),
            'title' => $this->getTitle(),
            'emitted_by' => auth()->user()->username,
        ];
    }
}
