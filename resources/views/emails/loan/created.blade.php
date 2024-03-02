<x-mail::message>
# Hello {{$loan->user->fullname}}

We are pleased to inform you that your loan request has been successfully created.
The next step involves the review and approval process by the Admin, which will be initiated once all designated Guarantor(s) have approved the request.

<x-mail::button :url="route('loans.show', ['loan' => $loan->id])">
View Loan
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
