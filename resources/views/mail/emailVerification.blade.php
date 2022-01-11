@component('mail::message')
# Hi {{ $name }},

We're excited to have you get started. First, you need to confirm your email address. 
Your email verification code is <code>{{ $token }}</code>

Thanks,<br>
PrepareHow
@endcomponent
