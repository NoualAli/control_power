<?php

namespace App\Notifications;

use App\Models\ControlCampaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ControlCampaignNotification extends Notification
{
    use Queueable;

    /**
     * @var App\Models\ControlCampaign
     */
    private $campaign;
    /**
     * @var Boolean
     */
    private $created;
    /**
     * @var string
     */
    private $title;
    /**
     * @var String
     */
    private $content;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ControlCampaign $campaign, $created = true)
    {
        $this->campaign = $campaign;
        $this->created = $created;
        $this->title = 'Création d\'une nouvelle campagne de contrôle ' . $this->campaign->reference;
        $this->content = 'Nous vous informons qu\'une nouvelle campagne de contrôle avec la référence ' . $this->campaign->reference . ' vient d\'être créer';

        if (!$this->created) {
            $this->title = 'Mise à jour de la campagne de contrôle ' . $this->campaign->reference;
            $this->content = 'Des modifications ont étaient apportés à la campagne de contrôle avec la référence ' . $this->campaign->reference;
        }
        if ($this->campaign->remaining_days_before_start <= 5) {
            $this->title = 'Rappel: lancement de la campagne de contrôle ' . $this->campaign->reference;
            $this->content = 'La campagne de contrôle avec la référence ' . $this->campaign->reference . ' débutera bientôt';
        }
        if ($this->campaign->remaining_days_before_start == 0) {
            $this->title = 'Lancement de la campagne de contrôle ' . $this->campaign->reference;
            $this->content = 'La campagne de contrôle avec la référence ' . $this->campaign->reference . ' vient d\'être lancée';
        }
        if ($this->campaign->remaining_days_before_end == 0) {
            $this->title = 'Fin de la campagne de contrôle ' . $this->campaign->reference;
            $this->content = 'La campagne de contrôle avec la référence ' . $this->campaign->reference . ' vient de s\'achevée';
        }
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
        // return ['database'];
    }

    /**
     * Get action url
     *
     * @return string
     */
    private function getUrl(): string
    {
        return url('/campaigns/' . $this->campaign->id);
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $startingSuffix = $this->campaign->remaining_days_before_start > 1 ? ' jours' : ' jour';
        $endingSuffix = $this->campaign->remaining_days_before_end > 1 ? ' jours' : ' jour';
        $startingLine = 'La campagne débutera le ' . $this->campaign->start . ' dans exactement ' . $this->campaign->remaining_days_before_start . $startingSuffix;
        $endingLine = 'La campagne se terminera le ' . $this->campaign->end . ' dans exactement ' . $this->campaign->remaining_days_before_end . $endingSuffix;

        if ($this->campaign->remaining_days_before_start == 0) {
            $startingLine = '';
        }
        if ($this->campaign->remaining_days_before_end == 0) {
            $startingLine = '';
            $endingLine = '';
        }

        return (new MailMessage)
            ->subject($this->title)
            ->line($this->content)
            ->line($startingLine)
            ->line($endingLine)
            ->line('Pour plus de détails veuillez cliquer sur le lien ci-dessous')
            ->action('Voir la campagne de contrôle', env('APP_URL') . '/campaigns/' . $this->campaign->id)
            ->line('Merci d\'utiliser notre application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'id' => $this->campaign->id,
            'url' => $this->getUrl(),
            'content' => $this->content,
            'title' => $this->title,
        ];
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
            'id' => $this->campaign->id,
            'url' => $this->getUrl(),
            'content' => $this->content,
            'title' => $this->title,
        ];
    }
}
