@component('mail::message')
# Welcome, {{$user['email']}} !!

@component('mail::button', ['url' => route('verify', Crypt::encrypt($user->id))])
Verifikasi Email
@endcomponent


Thanks,<br>
{{ config('app.name') }}
@endcomponent
