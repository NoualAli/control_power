<?php

namespace App\Notifications;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserCreatedNotification extends Notification
{
    use Queueable;

    /**
     * @var App\Models\User
     */
    private $user;

    /**
     * @var string
     */
    private $password;

    /**
     * Create a new notification instance.
     * @param App\Models\User $user
     * @param string $password
     * @return void
     */
    public function __construct(User $user, string $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Get email body
     *
     * @return array
     */
    private function getContent(): array
    {
        $role = $this->user->username == 'DGA' ? 'Directeur Général Adjoint' : $this->user->role->name;
        $ligns = [
            'Nous vous informons qu\'un compte utilisateur de type ' . $role . ' a été créer en votre nom',
            'Informations d\'authentification :',
            'Nom d\'utilisateur : ' . $this->user->username,
            'Adresse e-mail : ' . $this->user->email,
            'Mot de passe : ' . $this->password,
        ];
        return $ligns;
        // return 'Nous vous informons qu\'un compte utilisateur a été créer en votre nom';
    }

    /**
     * Get email subject
     *
     * @return string
     */
    private function getTitle(): string
    {
        return 'Utilisateur ControlPower';
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
        if (app()->environment('production')) {
            return ['mail'];
        }
        return ['mail'];
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
            ->line($this->getContent()[0])
            ->line($this->getContent()[1])
            ->line($this->getContent()[2])
            ->line($this->getContent()[3])
            ->line($this->getContent()[4])
            ->line('Vous pouvez utiliser votre e-mail ou votre identifiant pour ouvrir une session.')
            ->action('Se connecter', $this->getUrl())
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
            'id' => $this->user->id,
            'url' => $this->getUrl(),
            'content' => $this->getContent(),
            'title' => $this->getTitle(),
            'emitted_by' => 'système',
        ];
    }
}
