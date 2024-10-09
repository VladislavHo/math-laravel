<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Оплата прошла</title>
</head>
<body>
  <main style="width: 100%; height: 100vh; display: flex; align-items: center; justify-content: center;">

    <div class="wrapper" style="display: flex; flex-direction: column; align-items: center">
      <img style="width: 200px; height: 200px" src="https://cdn-icons-png.flaticon.com/512/463/463574.png" alt="success">

      <a style="font: normal 16px/1.5 'Open Sans', sans-serif; color: #000; margin-top: 20px" class="button" href="{{env('APP_URL')}}/calendar" target="_self">Перейти к записи</a>
    </div>


    {{-- <a href="{{ route('home') }}">Вернуться на главную</a> --}}
  </main>
</body>
</html>