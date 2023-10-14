<?php

namespace App\Notifications\Mission;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Reminder extends Notification
{
    use Queueable;

    /**
     * @var App\Models\Mission
     */
    private $mission;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
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
        return url('/missions/' . $this->mission->id);
        // return url('/missions/' . $this->mission->id);
    }

    /**
     * Get Email / Notification title (subject)
     *
     * @return string
     */
    private function getTitle(): string
    {
        $title = 'Rappel';
        if ($this->mission->remaining_days_before_start <= 5) {
            $title = 'Rappel: départ de la mission ' . $this->mission->reference;
        }
        if ($this->mission->remaining_days_before_start == 0) {
            $title = 'Rappel: commencement de la mission ' . $this->mission->reference;
        }
        if ($this->mission->remaining_days_before_end == 0) {
            $title = 'Rappel: Fin de la mission ' . $this->mission->reference;
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
        $remainingDaysStart = $this->mission->remaining_days_before_start;
        $remainingDaysEnd = $this->mission->remaining_days_before_end;

        $content = 'La mission avec la référence ' . $this->mission->reference . ' au niveau de l\'agence ' . $this->mission->agency->full_name . ' débutera bientôt';

        if ($remainingDaysStart == 0) {
            $content = 'La mission avec la référence ' . $this->mission->reference . ' au niveau de l\'agence ' . $this->mission->agency->full_name . ' débute aujourd\'hui';
        }
        if ($remainingDaysEnd == 0) {
            $content = 'La mission avec la référence ' . $this->mission->reference . ' au niveau de l\'agence ' . $this->mission->agency->full_name . ' se termine ajourd\'hui';
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
        $remainingDays = $this->mission->remaining_days_before_start;
        $startingSuffix = $this->mission->remaining_days_before_start > 1 ? ' jours' : ' jour';
        $startingLine = 'La mission débutera le ' . $this->mission->start . ' dans exactement ' . $this->mission->remaining_days_before_start . $startingSuffix;

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
        $remainingDays = $this->mission->remaining_days_before_end;
        $endingSuffix = $this->mission->remaining_days_before_end > 1 ? ' jours' : ' jour';
        $endingLine = 'La mission se terminera le ' . $this->mission->end . ' dans exactement ' . $this->mission->remaining_days_before_end . $endingSuffix;
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
            ->action('Voir La mission', $this->getUrl())
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
            'title' => $this->getTitle(),
            'emitted_by' => auth()->user()->full_name,
        ];
    }
}
