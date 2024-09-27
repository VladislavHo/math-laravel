<!DOCTYPE html>
<html>
<head>
    <title>Запланированное письмо</title>
</head>
<body>
<main>
    <p>Добрый день, {{$userName}} !</p><br>
    <img src="{{ asset('images/photo_2024-09-27_11-30-32.jpg') }}" alt="Описание изображения" style="max-width: 100%; height: auto;">


    <p>Уже через 1 час мы встречаемся с вами и вашим ребенком для того, чтобы:</p>
    <p>&nbsp;- Уточнить ваш запрос по учебе ребенка за рубежом по математике, физике, программированию (Точка Б)</p>
    <p>&nbsp;- Определить, что знает ребенок на данный момент (Точка А)</p>
    <br>


    <p>После встречи мы предоставим вам:</p>
    <p>&nbsp;- Индивидуальный, рассчитанный только под ваши цели и знания, план занятий: как гарантированно перейти от точки А в точку Б?</p>
    <p>&nbsp;- Индивидуальные рекомендации по выбору пакетов: Тьютор, Научный или Самомотивация</p>
    <br>



    <p>Не забудьте оснастить ребенка ручкой и тетрадкой, а также смартфоном для пересылки решений по Телеграм!🙂</p>

    <p>Ждем вас сегодня,  {{ $dateUserFormat }} в {{$timeUserFormat}} по ссылке: https://meet.google.com/qkv-mxrk-ehn?authuser=0</p><br><br>


    <p>До встречи🤗</p>
    <p>Команда MathHelp</p>



</main>
</body>
</html>