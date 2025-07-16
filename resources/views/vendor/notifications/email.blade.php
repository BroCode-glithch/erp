<x-mail::message>
{{-- Optional Logo --}}
@isset($logo)
<img src="{{ $logo }}" alt="{{ setting('general.site_name') }} Logo" style="height: 60px; margin: 0 auto 20px; display: block;">
@endisset

{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# Oops!
@else
# Hello!
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    $color = match ($level) {
        'success', 'error' => $level,
        default => 'primary',
    };
?>
<x-mail::button :url="$actionUrl" :color="$color">
    {{ strtoupper($actionText) }}
</x-mail::button>
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
Warm regards,  
**{{ setting('general.site_name') }}**
@endif

{{-- Subcopy --}}
@isset($actionText)
<x-slot:subcopy>
@if (!empty($actionUrl))
If you're having trouble clicking the "**{{ $actionText }}**" button, copy and paste the URL below into your web browser:  
[{{ $displayableActionUrl }}]({{ $actionUrl }})
@endif
</x-slot:subcopy>
@endisset

{{-- Optional Footer --}}
<hr style="margin-top: 30px;">
<p style="font-size: 12px; color: #888;">
    © {{ now()->year }} {{ setting('general.site_name') }}. All rights reserved.
</p>
</x-mail::message>
