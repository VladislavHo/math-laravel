<?php


namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Models\User;
use Log;
use Carbon\Carbon;

class TelegramController extends Controller
{
  protected $telegramService;

  public function sendMessageToUser(Request $request)
  {
    $userId = $request->user_id;
    $date = $request->date;
    $time = $request->time;

    $dateFormat = date('d.m.Y', strtotime($date));
    $dateCarbonFormat = Carbon::createFromFormat('d.m.Y', $dateFormat)->locale('ru')->translatedFormat('j F Y');
    ;
    $timeFormat = date('H:i', strtotime($time));



    $user = User::find($userId);

    $chatId = $user->telegram_id;
    $name = $user->name;

    $message = 'Добрый день,  ' . $name . '! 

Спасибо на тестирование и консультацию в команду инновационного проекта MathHelp🤗, который позволяет гарантированно достигать академических целей на западе за счет использования научных знаний и инновационных AI решений.

Вы записались к нам на встречу ' . $dateCarbonFormat . ' в ' . $timeFormat . '. 

Встреча будет проходить следующим образом:
Этап 1. До 30 минут - разговор с родителями по целям, задачам обучения. Необходимо присутствие только родителя. 
Этап 2. До 30 минут - тестирование ребенка на установление уровня знаний в соответствии с задачами, определенными на Этапе 1. Для установления контакта желательно присутствие только ребенка, хотя мы готовы адаптировать формат🙂

Будем ждать Вас в указанное время! 

Мы пришлем Вам ссылку на встречу в Телеграм Боте и по emal за 1 час до встречи. 

До встречи🙂, 
Ваша команда MathHelp. 

P.S. Если Ваши планы изменятся, пожалуйста, сообщите об этом заранее по e-mail: zhborodaeva@gmail.com';


    $telegram_token = env('TELEGRAM_TOKEN');

    $url = "https://api.telegram.org/bot$telegram_token/sendMessage";

    $data = [
      'chat_id' => $chatId,
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

    return json_decode($result, true);
  }

}