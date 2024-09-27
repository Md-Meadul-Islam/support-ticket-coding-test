@component('mail::message')
A new ticket has been created.
**Subject:** {{ $subject }}  
**Description:** {{ $desc }}

@component('mail::button', ['url' => route('admin.dashboard')])
View Ticket
@endcomponent

Thanks,  
{{ config('app.name') }}
@endcomponent
