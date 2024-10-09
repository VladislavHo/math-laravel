<?php


namespace App\Telegram;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Stringable;
use DefStudio\Telegraph\Keyboard\ReplyButton;
use DefStudio\Telegraph\Keyboard\ReplyKeyboard;
use App\Models\User;
use Log;
class Handler extends WebhookHandler
{
  public function calendar(): void
  {
    $currentMonth = date('F Y'); // Текущий месяц и год
    $daysInMonth = date('t'); // Количество дней в месяце
    $firstDayOfMonth = date('w', strtotime("first day of this month")); // Первый день месяца (0 - воскресенье, 6 - суббота)

    // Создаем клавиатуру
    $keyboard = ReplyKeyboard::make()
      ->row([
        ReplyButton::make($currentMonth),
        ReplyButton::make('Вперед'),
      ])
      ->row([
        ReplyButton::make('Пн'),
        ReplyButton::make('Вт'),
        ReplyButton::make('Ср'),
        ReplyButton::make('Чт'),
        ReplyButton::make('Пт'),
        ReplyButton::make('Сб'),
        ReplyButton::make('Вс'),
      ]);

    // Добавляем пустые кнопки для выравнивания
    $row = [];
    for ($i = 0; $i < $firstDayOfMonth; $i++) {
      $row[] = ReplyButton::make('Пусто'); // Пустая кнопка для выравнивания
    }

    // Генерируем кнопки для каждого дня месяца
    for ($day = 1; $day <= $daysInMonth; $day++) {
      $row[] = ReplyButton::make((string) $day);

      // Добавляем строку в клавиатуру после каждых 7 кнопок (неделя)
      if (count($row) === 7) {
        $keyboard->row($row);
        $row = []; // Сбрасываем строку
      }
    }

    // Если последняя строка не заполнена, добавляем пустые кнопки
    if (count($row) > 0) {
      while (count($row) < 7) {
        $row[] = ReplyButton::make(''); // Добавляем пустые кнопки до 7
      }
      $keyboard->row($row);
    }

    // Отправляем сообщение с календарем
    $this->chat->html("Календарь на $currentMonth:")->replyKeyboard($keyboard)->send();
  }

  public function start(): void
  {


    $update = json_decode(file_get_contents('php://input'), true);
    // $message = $update['message'];
    if (isset($update['callback_query'])) {
      $callbackQuery = $update['callback_query'];
      $userId = $callbackQuery['from']['id'];
      User::create([
        'telegram_id' => $userId,
      ]);
    } else if (isset($update['message'])) {
      $message = $update['message'];
      $userId = $message['from']['id'];

    } else {
      $this->chat->html('Нет информации о пользователе.')->send();
      return;
    }


    $user = User::where('telegram_id', $userId)->first();

    if($user) {
      User::where('telegram_id', $userId)->update([
        'telegram_id' => $userId,
      ]);
    }else{
      User::create([
        'telegram_id' => $userId,
      ]);
    }

    $textHello = 'Добрый день! 

Чтобы ознакомиться с нашим методом, который позволяет достигать любых учебных целей на западе, подпишитесь на наш телеграм канал';


    $this->chat->html($textHello)->keyboard(Keyboard::make()->buttons([
      Button::make('Подписаться!')->url('https://t.me/foreignmath'),

    ]))->send();


    sleep(1);
    $this->chat->html('Давай проверим подписку?')->keyboard(Keyboard::make()->buttons([

      Button::make('Проверить подписку')->action("change"),
    ]))->send();



  }


  protected function handleUnknownCommand(Stringable $text): void
  {
    if ($text->value() === '/start') {
      $this->reply('Рад тебя видеть! Давай начнем пользоваться мной :-)');
    } else {
      $this->reply('Неизвестная команда');
    }
  }

  public function change(): void
  {

    $update = json_decode(file_get_contents('php://input'), true);
    $app_url = env('APP_URL');

    if (isset($update['callback_query'])) {
      $callbackQuery = $update['callback_query'];
      $telegramId = $callbackQuery['from']['id'];
    } else if (isset($update['message'])) {
      $message = $update['message'];
      $telegramId = $message['from']['id'];
    } else {
      $this->chat->html('Нет информации о пользователе.')->send();
      return;
    }


    $token = env('TELEGRAM_TOKEN');
    $changeGroup = '@foreignmath';

    $urlChangeGroup = "https://api.telegram.org/bot$token/getChatMember?chat_id=$changeGroup&user_id=$telegramId";

    try {
      $response = file_get_contents($urlChangeGroup);
      $data = json_decode($response, true);
    } catch (\Exception $e) {
      $this->chat->html('Ошибка при выполнении запроса: ' . $e->getMessage())->send();
      return;
    }

    // Проверка на ошибки в ответе
    if (isset($data['ok']) && $data['ok'] === false) {
      $this->chat->html('Ошибка: ' . $data['description'])->send();
      return;
    }

    if (isset($data['result']['status'])) {
      if (!ini_get('allow_url_fopen')) {

      }
      $status = $data['result']['status'];
      if ($status === 'member' || $status === 'administrator' || $status === 'creator') {

       $user =  User::where('telegram_id', $telegramId)->update([
          'is_subscribed' => true,
        ]);

      $userId = User::where('telegram_id', $telegramId)->first()->id;

        $this->chat->html('Спасибо, что подписались')->send();

        sleep(1);
        $text = 'Держите подробный разбор используемого нами метода, который позволяет повышать оценки с F до A, переходить в группу «задача со звездочкой», успешно сдавать экзамены по математике, в конце концов поступать в лучшие университеты запада. Без пушинга!

        Благодаря данному методу сотни моих учеников уже достигли своих академических и даже карьерных целей в странах запада. 
        
        Знания из этой статьи дают возможность уже сейчас понять, что нужно вашему ребенку, чтобы преуспеть в учебе на западе и поступить в учебные заведения вашей мечты. 
        
        В методе нет никакой необходимости заставлять ребенка учиться, т.к. он построен на самомотивации ребенка.  Максимум отдыха и минимум напряжения для вас с хорошим результатом в учебе у ребенка, - о чем еще можно мечтать?
        
        Жмите на кнопку ниже и забирайте статью с разбором метода.';
        
        $this->chat->html($text)->keyboard(Keyboard::make()->buttons([
          Button::make('Забрать статью')->url("$app_url/$userId/article"),
        ]))->send();

      } else {
        User::where('telegram_id', $telegramId)->update([
          'is_subscribed' => false,
        ]);
        $this->chat->html('Вы не подписались')->keyboard(Keyboard::make()->buttons([
          Button::make('Подпишись на канал и забирай статью')->url('https://t.me/foreignmath'),

        ]))->send();
      }
    } else {
      $this->chat->html('Не удалось получить статус пользователя.')->send();
    }
  }


}