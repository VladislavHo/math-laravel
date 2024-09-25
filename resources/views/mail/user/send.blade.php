{{-- @component('mail::message')
Вы записаны на дату: {{ $date }},
Время: {{ $time }},
Мы свяжемся с вами заранее!

@endcomponent --}}

<!DOCTYPE html>
<html>
<head>
    <title>Уведомление</title>
</head>
<body>
    <h1>Уведомление</h1>
    <p>Вы записаны на дату: {{ $date }}</p>
    <p>Время: {{ $time }}</p>
</body>
</html>
