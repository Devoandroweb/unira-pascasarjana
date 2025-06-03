<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\URL;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RegisterUserNotification extends Notification
{

    private $user;
    protected $password;
    /**
     * Create a new notification instance.
     */
    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $verificationUrl = $this->verificationUrl($notifiable);
        return (new MailMessage)
            ->subject(__("New Account"))
            ->greeting(__("Congratulations, Your Account Has Been Registered"))
            ->line(__("Below is your detailed account information") . ' :')
            ->line(__("Name") . ' : ' . $this->user->name)
            ->line(__("Email") . ' : ' . $this->user->email)
            ->line(__("Username") . ' : ' . $this->user->username)
            ->line(__("Password") . ' : ' . $this->password)
            ->action(__('Verify Email Address'), $verificationUrl)
            ->salutation('Admin');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification())
            ]
        );
    }
}
