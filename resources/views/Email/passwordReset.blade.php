@component('mail::message')
    # Introduction

    Body ...

    @component('mail::button', ['url' => 'http://localhost:8080/reset-password'."?email=$email"."&token=$token"])
        Click here
    @endcomponent

    Thanks,

    {{ config('app.name') }}
@endcomponent
