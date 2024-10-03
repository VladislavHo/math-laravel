<?php



namespace App\Services;
use App\Models\User;
use Carbon\Carbon;


class ScheduledTelegram {
  public function sendMessage($email){


    $user = User::where('email', $email)->first();
    $appointments = User::with('appointments')->find($user->id);
    // $user = User::find($email);

    $date = Carbon::parse($appointments->date)->locale('ru')->translatedFormat('j F Y');
    $time = Carbon::parse($appointments->time)->locale('ru')->addHour()->translatedFormat('H:i');


    $message = 'Добрый день, ' . $user->name . '!

Уже через 1 час мы встречаемся с вами и вашим ребенком для того, чтобы:
- Уточнить ваш запрос по учебе ребенка за рубежом по математике, физике, программированию (Точка Б)
- Определить, что знает ребенок на данный момент (Точка А)

После встречи мы предоставим вам: 
- Индивидуальный, рассчитанный только под ваши цели и знания, план занятий: как гарантированно перейти от точки А в точку Б?
- Индивидуальные рекомендации по выбору пакетов: Тьютор, Научный или Самомотивация

Не забудьте оснастить ребенка ручкой и тетрадкой, а также смартфоном для пересылки решений по Телеграм!🙂

Ждем вас сегодня, ' . $date . ' в ' . $time . ' по ссылке: https://meet.google.com/qkv-mxrk-ehn?authuser=0

До встречи🤗
Команда MathPad';

    $telegram_token = env('TELEGRAM_TOKEN');

    $url = "https://api.telegram.org/bot$telegram_token/sendMessage";

    $data = [
      'chat_id' => $user->telegram_id,
      'text' => $message,
    ];

    $options = [
      'http' => [
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => http_build_query($data),
      ],
    ];

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
      die('Error occurred');
    }
    
  }
}
