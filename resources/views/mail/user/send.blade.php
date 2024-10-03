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
    {{-- <h1>Уведомление</h1>
    <p>Вы записаны на дату: {{ $date }}</p>
    <p>Время: {{ $time }}</p> --}}

    <p>Добрый день, {{$userName}} !</p> <br>

    <p>Спасибо за тестирование и консультацию в команду инновационного проекта MathPad🤗, который позволяет гарантированно достигать академических целей на западе за счет использования научных знаний и инновационных AI решений.
    </p> <br>


    <p>Вы записались к нам на встречу {{ $date }} в {{ $time }}. 
    </p><br>


    <p>
        Встреча будет проходить следующим образом:
        <br>
        Этап 1. До 30 минут - разговор с родителями по целям, задачам обучения. Необходимо присутствие только родителя. 
        <br>
        Этап 2. До 30 минут - тестирование ребенка на установление уровня знаний в соответствии с задачами, определенными на Этапе 1. Для установления контакта желательно присутствие только ребенка, хотя мы готовы адаптировать формат🙂
    </p>
    <br>

    <p>
        Будем ждать Вас в указанное время! 
    </p>
    <br>

    <p>
        До встречи🙂, 
Ваша команда MathPad. 
    </p>

    <br>
    <p>
        P.S. Если Ваши планы изменятся, пожалуйста, сообщите об этом заранее по e-mail: zhborodaeva@gmail.com';
    </p>

</body>
</html>


{{-- 'Добрый день,  ' . $name . '! 

Спасибо на тестирование и консультацию в команду инновационного проекта MathPad🤗, который позволяет гарантированно достигать академических целей на западе за счет использования научных знаний и инновационных AI решений.

Вы записались к нам на встречу ' . $dateCarbonFormat . ' в ' . $timeFormat . '. 

Встреча будет проходить следующим образом:
Этап 1. До 30 минут - разговор с родителями по целям, задачам обучения. Необходимо присутствие только родителя. 
Этап 2. До 30 минут - тестирование ребенка на установление уровня знаний в соответствии с задачами, определенными на Этапе 1. Для установления контакта желательно присутствие только ребенка, хотя мы готовы адаптировать формат🙂

Будем ждать Вас в указанное время! 

Мы пришлем Вам ссылку на встречу в Телеграм Боте и по emal за 1 час до встречи. 

До встречи🙂, 
Ваша команда MathPad. 

P.S. Если Ваши планы изменятся, пожалуйста, сообщите об этом заранее по e-mail: zhborodaeva@gmail.com'; --}}