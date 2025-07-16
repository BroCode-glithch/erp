<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class WelcomeUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Welcome to ' . config('app.name'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        // Used a markdown template for the email content
        // This allows for better styling and structure
        return new Content(
            markdown: 'emails.welcome-user',
            with: [
                'user' => $this->user,
                'dashboardUrl' => $this->resolveDashboardRoute($this->user),
            ],
        );
    }

    protected function resolveDashboardRoute(User $user): string
    {
        // Redirect based on user role
        if ($user->hasRole('admin')) {
            return route('admin.dashboard');
        }

        if ($user->hasRole('program-manager')) {
            return route('pm.dashboard');
        }

        if ($user->hasRole('care-support')) {
            return route('care.dashboard');
        }

        return route('dashboard'); // fallback/default
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }

    
}
