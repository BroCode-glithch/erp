@component('mail::message')
# Welcome {{ $user->name }} 👋

Thank you for joining **{{ setting('general.site_name') }}**!

Here’s what you can expect:

- Access to your personalized dashboard
- Role: **{{ $user->getRoleNames()->first() ?? 'User' }}**
- System support and resources
- Optional 2FA security setup

@component('mail::button', ['url' => $dashboardUrl])
Go to Dashboard
@endcomponent

If you have any questions or need support, just reply to this email or contact us.

Thanks,<br>
The {{ setting('general.site_name') }} Team
@endcomponent
