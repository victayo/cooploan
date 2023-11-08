<x-mail::message>
# Hello {{$guarantor->fullname}}

<strong>{{$user->fullname}}</strong> is requesting that you guarantee the amount of {{$guarantor->amount}} for a loan request. Kindly follow the link below to approve/reject the request.

<x-mail::button :url="$url">
Approve/Reject
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
