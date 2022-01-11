@component('mail::message')
# Hi {{ $user->name }},

Your password reset code is <code>{{ $token }}</code>. <br>
If you didn't send password reset request, ignore this message

Thanks,<br>
PrepareHow
@endcomponent
