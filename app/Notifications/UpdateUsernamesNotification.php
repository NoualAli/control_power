<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use stdClass;

class UpdateUsernamesNotification extends Notification
{
    use Queueable;

    /**
     * @var stdClass
     */
    private $user;

    /**
     * @var stdClass
     */
    private $role;

    /**
     * Create a new notification instance.
     * @param \App\Models\User $user
     * @param string $password
     * @return void
     */
    public function __construct(stdClass $role, stdClass $user)
    {
        $this->user = $user;
        $this->role = $role;
    }

    /**
     * Get email body
     *
     * @return array
     */
    private function getContent(): array
    {
        $role = $this->role->name;
        $ligns = [
            'Nous vous informons que votre nom d\'utilisateur (Profil : ' . $role . ') a été mis à jour avec succès.',
            'Votre nom d\'utilisateur passe de ' . $this->user->username . ' à ' . $this->user->new_username,
            'Vous avez la possibilité de vous connecter en utilisant soit votre adresse e-mail ou votre nouveau nom d\'utilisateur.',
            'Veuillez noter qu\'il est obligatoire de changer votre mot de passe lors de votre première connexion.',
            'Garder votre mot de passe confidentiel pour assurer la sécurité de votre compte. Nous ne pourrons être tenus responsables de tout accès non autorisé résultant d\'informations de connexion partagées.',
            'Pour une meilleure expérience d\'utilisation de la plateforme CONTROL POWER, nous vous recommandons d\'utiliser un navigateur web tel que Microsoft Edge ou Google Chrome',
            'Pour toutes difficultés ou informations complémentaires, il y a lieu de se rapprocher de la Direction du contrôle permanent (D.C.P)',
        ];
        return $ligns;
    }

    /**
     * Get database body
     *
     * @return array
     */
    private function getShortContent(): string
    {
        return 'Nous vous informons votre nom d\'utilisateur passe de <b>' . $this->user->username . '</b> à <b>' . $this->user->new_username . '</b>';
    }

    /**
     * Get email subject
     *
     * @return string
     */
    private function getTitle(): string
    {
        return 'MISE A JOUR NOM D\'UTILISATEUR - ' . env('APP_NAME');
    }

    /**
     * Get action url
     *
     * @return string
     */
    private function getUrl(): string
    {
        return env('APP_URL');
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
            ->greeting(' ')
            ->subject($this->getTitle())
            ->line($this->getContent()[0])
            ->line($this->getContent()[1])
            ->line($this->getContent()[2])
            ->line($this->getContent()[3])
            ->line($this->getContent()[4])
            ->line($this->getContent()[5])
            ->line($this->getContent()[6])
            ->action('Se connecter', $this->getUrl())
            // ->line('Merci d\'utiliser ControlPower!')
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
            'id' => $this->user->id,
            'url' => $this->getUrl(),
            'content' => $this->getContent(),
            'short_content' => $this->getContent(),
            'title' => $this->getTitle(),
            'emitted_by' => auth()?->user()?->username,
        ];
    }
}
