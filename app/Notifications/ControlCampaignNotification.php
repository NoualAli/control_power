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

    private $campaign;
    private $created;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ControlCampaign $campaign, $created = true)
    {
        $this->campaign = $campaign;
        $this->created = $created;
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
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $subject = 'Création d\'une nouvelle campagne de contrôle #' . $this->campaign->reference;
        $introduction = 'Nous vous informons qu\'une nouvelle campagne de contrôle avec la référence #' . $this->campaign->reference . ' vient d\'être créer';
        $startingSuffix = $this->campaign->remaining_days_before_start > 1 ? ' jours' : ' jour';
        $endingSuffix = $this->campaign->remaining_days_before_end > 1 ? ' jours' : ' jour';
        $startingLine = 'La campagne débutera le ' . $this->campaign->start . ' dans exactement ' . $this->campaign->remaining_days_before_start . $startingSuffix;
        $endingLine = 'La campagne se terminera le ' . $this->campaign->end . ' dans exactement ' . $this->campaign->remaining_days_before_end . $endingSuffix;
        if (!$this->created) {
            $subject = 'Mise à jour de la campagne de contrôle #' . $this->campaign->reference;
            $introduction = 'Des modifications ont étaient apportés à la campagne de contrôle avec la référence #' . $this->campaign->reference;
        }
        if ($this->campaign->remaining_days_before_start <= 5) {
            $subject = 'Rappel: lancement de la campagne de contrôle #' . $this->campaign->reference;
            $introduction = 'La campagne de contrôle avec la référence #' . $this->campaign->reference . ' débutera bientôt';
        }
        if ($this->campaign->remaining_days_before_start == 0) {
            $subject = 'Lancement de la campagne de contrôle #' . $this->campaign->reference;
            $introduction = 'La campagne de contrôle avec la référence #' . $this->campaign->reference . ' vient d\'être lancée';
            $startingLine = '';
        }
        if ($this->campaign->remaining_days_before_end == 0) {
            $subject = 'Fin de la campagne de contrôle #' . $this->campaign->reference;
            $introduction = 'La campagne de contrôle avec la référence #' . $this->campaign->reference . ' vient de s\'achevée';
            $startingLine = '';
            $endingLine = '';
        }

        return (new MailMessage)
            ->subject($subject)
            ->line($introduction)
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
            'campaign_id' => $this->campaign->id,
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
            //
        ];
    }
}