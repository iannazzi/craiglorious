@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>{{ $title }}</h2>

<div>
    {!! $intro . link_to('auth/confirm/' . $confirmation_code, $link) !!}.<br>
</div>
</body>
</html>