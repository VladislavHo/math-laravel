<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Новая запись!</title>
</head>
<body>
  <h1>Вам Новая запись!</h1>

  <div style="margin-bottom: 20px">
    <p><strong>Дата: {{ $date }}</strong></p>
    <p><strong>Время: {{ $time }}</strong></p>
  </div>

  <div style="margin-bottom: 20px">
  <p>ID: {{ $questionnaire->user_id }}</p>
  <p>Telegtram Name: <a href="https://t.me/{{ $questionnaire->telegram_name }}">{{ $questionnaire->telegram_name }}</a></p>
  <p>Имя: {{ $questionnaire->name }}</p>
  <p>Фамилия: {{ $questionnaire->lastName }}</p>
  <p>Телефон: {{ $questionnaire->phone }}</p>
  <p>E-mail: {{ $questionnaire->email }}</p>

  </div>

  <div style="border: 1px solid black; padding: 10px">
    <ul>
      <p><strong>В какой западной стране ваш ребенок учится или будет учиться?</strong></p>
      <li>{{$questionnaire->country}}</li>
    </ul>
    <ul>
      <p><strong>Какие задачи в области математики, физики и программирования стоят на данный момент?*</strong></p>
      <li>{{$questionnaire->tasks}}</li>
    </ul>
  
    <ul>
      <p><strong>В какой срок необходимо решить задачи предыдущего пункта?*</strong></p>
      <li>
        {{$questionnaire->deadline}}
      </li>
    </ul>
  
    <ul>
      <p><strong>Возраст вашего ребенка*</strong></p>
      <li>
        {{$questionnaire->age}}
      </li>
    </ul>
    <ul>
      <p>
        <strong>Сколько вы готовы вкладывать в месяц в достижение академических целей по математике и программированию?*</strong>
      </p>
      <li>
        {{$questionnaire->investment}}
      </li>
    </ul>
  </div>
</body>
</html>