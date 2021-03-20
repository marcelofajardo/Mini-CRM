@component('mail::message')
# Hello, {{ $user->name }}

You received this mail because you've created a company called `{{ $company->name }}`

Thanks,<br>
{{ config('app.name') }}
@endcomponent
