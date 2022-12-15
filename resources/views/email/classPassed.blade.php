@component('mail::message')
# Certificate of Training
## {{ $category->title }}

@component('mail::button', ['url' =>  url('/certificate') .'/'. $category->id ])
Download Certificate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
