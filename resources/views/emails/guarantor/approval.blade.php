<x-mail::message>
# Hello {{$user->fullname}}

Kindly note that your guarantor request for loan ID <strong>#{{$loan->id}}</strong> has been <strong>{{$approvalStatus}}</strong>

<x-mail::button :url="$loanUrl">
View Loan
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
