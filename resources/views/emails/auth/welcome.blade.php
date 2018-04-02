@component('mail::message')
# Introduction


@component('mail::panel')
	Hello world and Welcome {{ $username }} {{ $email }}
@endcomponent

@component('mail::button', ['url' => route('auth.verify', ['token' => $token], true)])
	Click here
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
