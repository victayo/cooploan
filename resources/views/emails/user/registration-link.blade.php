<x-mail::message>
# Welcome to Mainone Coop

Kindly click on the button below to complete the registration on Mainone Coop

<x-mail::button :url="$registrationLink">
Click to Register
</x-mail::button>

Use {{ $registrationLink }} if the link above does not work.

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
