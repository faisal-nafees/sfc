@component('mail::message')
@php
    extract(@$data->toArray());
@endphp
# Video Call requested by {{ $user['fname'] }}

Go to the following link to accept the video call:

@component('mail::button', ['url' => $videoCallUrl])
Accept Video Call
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
