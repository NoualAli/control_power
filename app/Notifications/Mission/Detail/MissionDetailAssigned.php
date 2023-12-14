<?php

namespace App\Notifications\Mission\Detail;

use App\Models\Mission;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MissionDetailAssigned extends Notification
{
    use Queueable;

    /**
     * @var \App\Models\User
     */
    protected $controller;

    /**
     * @var \App\Models\Mission
     */
    protected $mission;

    /**
     * @var \Illuminate\Database\Eloquent\Collection
     */
    protected $processes;

    /**
     * @param \App\Models\User $controller
     * @param \App\Models\Mission $mission
     * @param Collection $processes
     */
    public function __construct(User $controller, Mission $mission, Collection $processes)
    {
        $this->controller = $controller;
        $this->mission = $mission;
        $this->processes = $processes;
    }





    private function getProcessesString()
    {
        $content = '<ul>';
        foreach ($this->processes as $process) {
            $content .= '<li>' . $process->name . '</li>';
        }
        $content .= '</ul>';
        return $content;
    }

    /**
     * Get email body
     *
     * @return string
     */
    private function getContent(): string
    {
        $totalProcesses = $this->processes->count();
        $content = $totalProcesses > 1 ? "Des processus vous on était affectés" : "Un processus vous a était affecté";
        $content .= " pour traitement dans la mission " . $this->mission->reference;
        return $content;
    }

    /**
     * Get email subject
     *
     * @return string
     */
    private function getTitle(): string
    {
        $totalProcesses = $this->processes->count();
        return $totalProcesses > 1 ? 'ASSIGNATION DES PROCESSUS - ' . $this->mission->reference . ' - ' . env('APP_NAME') : 'ASSIGNATION D\'UN PROCESSUS - ' . $this->mission->reference . ' - ' . env('APP_NAME');
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
            ->subject($this->getTitle())
            ->greeting('Bonjour ' . $this->controller->full_name)
            ->line($this->getContent())
            ->line('Pour plus d\'informations veuillez vous rendre sur l\'application')
            ->action('Voir la mission', $this->getUrl())
            ->line('Merci d\'utiliser ControlPower')
            ->success();

        // return (new MailMessage)
        //     ->subject($this->getTitle())
        //     ->greeting('Bonjour ' . $this->controller->full_name)
        //     ->line($this->getContent())
        //     ->line('Liste des processus:')
        //     ->view('email_views.processes_list')
        //     ->with(['htmlContent' => 'test'])
        //     ->action('Voir la mission', $this->getUrl())
        //     ->line('Merci d\'utiliser ControlPower')
        //     ->success();
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
            'emitted_by' => auth()->user()->username,
        ];
    }
}
