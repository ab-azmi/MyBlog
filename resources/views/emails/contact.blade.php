@component('mail::message')
# Visitors Message

Some Visitor Left a Message
<br><br>
FirstName: {{$firstname}}
<br>
LastName: {{$lastname}}
<br>
Email: {{$email}}
<br>
Subject: {{$subject}}
<br><br>
Message: {{$message}}


@component('mail::button', ['url' => ''])
View Message
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
