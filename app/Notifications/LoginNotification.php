<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LoginNotification extends Notification
{

    use Queueable;

    /**
     * The location of the login.
     *
     * @var string
     */
    public $location;

    /**
     * Create a new notification instance.
     */
    public function __construct($location)
    {
        //
        $this->location = $location;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        // Customize the email message
        return (new MailMessage)
            ->subject('⚠️ New Login Detected!!!')
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('We detected a new login to your account on:')
            ->line($this->location)
            ->line("If this wasn't you, kindly reset your password immediately using the reset link below:")
            ->action('Reset Password',  route('password.email'));
    }

    public function toDatabase($notifiable)
    {
        // Store the login location in the database
        return [
            'message' => "New login detected: " . $this->location,
        ];
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
}
