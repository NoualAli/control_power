<?php

namespace App\Notifications\ControlCampaign;

use App\Models\ControlCampaign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Reminder extends Notification
{
    use Queueable;

    /**
     * @var int|\App\Models\ControlCampaign
     */
    private $campaign;

    /**
     * Create a new notification instance.
     * @param int|\App\Models\ControlCampaign
     *
     * @return void
     */
    public function __construct(int|ControlCampaign $campaign)
    {
        $this->campaign = is_integer($campaign) ? ControlCampaign::findOrFail($campaign) : $campaign;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if (!config('mail.default')) {
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
        return url('/campaigns/' . $this->campaign->id);
        // return url('/campaigns/' . $this->campaign->id);
    }

    /**
     * Get Email / Notification title (subject)
     *
     * @return string
     */
    private function getTitle(): string
    {
        $title = 'Rappel';
        if ($this->campaign->remaining_days_before_start <= 5) {
            $title = 'Rappel: lancement de la campagne de contrôle ' . $this->campaign->reference;
        }
        if ($this->campaign->remaining_days_before_start == 0) {
            $title = 'Rappel: Lancement de la campagne de contrôle ' . $this->campaign->reference;
        }
        if ($this->campaign->remaining_days_before_end == 0) {
            $title = 'Rappel: Fin de la campagne de contrôle ' . $this->campaign->reference;
        }

        return $title;
    }

    /**
     * Get Email / Notification content
     *
     * @return string
     */
    private function getContent(): string
    {
        $remainingDaysStart = $this->campaign->remaining_days_before_start;
        $remainingDaysEnd = $this->campaign->remaining_days_before_end;

        $content = 'La campagne de contrôle avec la référence ' . $this->campaign->reference . ' débutera bientôt';

        if ($remainingDaysStart == 0) {
            $content = 'La campagne de contrôle avec la référence ' . $this->campaign->reference . ' débute aujourd\'hui';
        }
        if ($remainingDaysEnd == 0) {
            $content = 'La campagne de contrôle avec la référence ' . $this->campaign->reference . ' se termine ajourd\'hui';
        }

        return $content;
    }

    /**
     * Get stating line
     *
     * @return string
     */
    private function getStartingLing(): string
    {
        $remainingDays = $this->campaign->remaining_days_before_start;
        $startingSuffix = $this->campaign->remaining_days_before_start > 1 ? ' jours' : ' jour';
        $startingLine = 'La campagne débutera le ' . $this->campaign->start_date . ' dans exactement ' . $this->campaign->remaining_days_before_start . $startingSuffix;

        if ($remainingDays == 0 || $remainingDays < 0) {
            $startingLine = '';
        }

        return $startingLine;
    }

    /**
     * Get stating line
     *
     * @return string
     */
    private function getEndingLine(): string
    {
        $remainingDays = $this->campaign->remaining_days_before_end;
        $endingSuffix = $this->campaign->remaining_days_before_end > 1 ? ' jours' : ' jour';
        $endingLine = 'La campagne se terminera le ' . $this->campaign->end_date . ' dans exactement ' . $this->campaign->remaining_days_before_end . $endingSuffix;
        if (!$remainingDays) {
            $endingLine = '';
        }
        return $endingLine;
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
            ->line($this->getStartingLing())
            ->line($this->getEndingLine())
            ->line('Pour plus de détails veuillez cliquer sur le lien ci-dessous')
            ->action('Voir la campagne de contrôle', $this->getUrl())
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
            'id' => $this->campaign->id,
            'url' => $this->getUrl(),
            'content' => $this->getContent(),
            'title' => $this->getTitle(),
        ];
    }
}
