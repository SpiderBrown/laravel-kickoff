@component('mail::message')
# Welcome

welcome to {{config('app')}}

Your account will be set up shortly, we will notify you when its ready.
@component('mail::button', ['url' => ''])
Checkout
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
