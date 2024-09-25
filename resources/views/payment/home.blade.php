<!DOCTYPE html>
<html>
<head>
    <title>Перенапровление на домашнюю страницу</title>
</head>
<body>

  <script type="text/javascript" defer>
    window.open('{{ env('APP_URL') }}', '_self');
  </script>
</body>
</html>