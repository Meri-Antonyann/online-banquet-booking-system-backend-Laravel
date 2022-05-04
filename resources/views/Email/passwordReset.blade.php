@component('mail::message')
    # Introduction

    Body ...

    @component('mail::button', ['url' => 'https://online-banquet-booking-system.herokuapp.com/reset-password'."?email=$email"."&token=$token"])
        Click here
    @endcomponent

    Thanks,

    {{ config('app.name') }}
@endcomponent
