<x-mail::message>
# Hello {{$loan->user->fullname}}

Kindly note that your loan request has been <strong>{{$loan->approval_status}}</strong>

@if ($loan->approval_status == 'approved')
    Loan ID: {{$loan->id}}
    Loan Amount: {{ $loan->loan_amount }}
    Loan Tenure: {{ $loan->tenure }}
@endif


<x-mail::button :url="route('loans.show', ['loan' => $loan->id])">
View Loan
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
