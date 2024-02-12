b<?php

    namespace App\Notifications\ControlCampaign;

    use App\Models\ControlCampaign;
    use Illuminate\Bus\Queueable;
    use Illuminate\Contracts\Queue\ShouldQueue;
    use Illuminate\Notifications\Messages\MailMessage;
    use Illuminate\Notifications\Notification;

    class Updated extends Notification
    {
        use Queueable;

        /**
         * @var int|\App\Models\ControlCampaign
         */
        private $campaign;

        /**
         * Create a new notification instance.
         * @param string|\App\Models\ControlCampaign
         *
         * @return void
         */
        public function __construct(string|ControlCampaign $campaign)
        {
            $this->campaign = is_string($campaign) ? ControlCampaign::findOrFail($campaign) : $campaign;
        }

        /**
         * Get the notification's delivery channels.
         *
         * @param  mixed  $notifiable
         * @return array
         */
        public function via($notifiable)
        {
            $channels = collect([]);
            $setting = $notifiable->notification_settings()->whereRelation('type', 'code', 'control_campaign_updated')->first();
            if ($setting?->database_is_enabled) {
                $channels->push('database');
            }

            if ($setting?->email_is_enabled && !config('mail.disabled')) {
                $channels->push('mail');
            }
            return $channels->toArray();
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
         * Get Email / Notification title (subject)
         *
         * @return string
         */
        private function getTitle(): string
        {
            return 'MISE À JOUR DE LA CAMPAGNE DE CONTRÔLE ' . $this->campaign->reference . ' - ' . env('APP_NAME');
        }

        /**
         * Get Email content
         *
         * @return string
         */
        private function getContent(): string
        {
            return 'Des modifications ont étaient apportés à la campagne de contrôle avec la référence ' . $this->campaign->reference;
        }

        /**
         * Get Notification content
         *
         * @return string
         */
        private function getHtmlContent(): string
        {
            return '<p>Des modifications ont étaient apportés à la campagne de contrôle avec la référence <b>' . $this->campaign->reference . '</b></p>';
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
                'short_content' => $this->getHtmlContent(),
                'title' => $this->getTitle(),
                'emitted_by' => auth()->user()->username,
            ];
        }
    }