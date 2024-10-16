<?php


namespace App\Telegram;

use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Stringable;

use App\Models\User;
use App\Models\Questionnaire;
use App\Models\Analytics;
use Log;
class Handler extends WebhookHandler
{
    public function start(): void
    {
        $update = json_decode(file_get_contents('php://input'), true);

        // Определяем, откуда получаем данные
        if (isset($update['callback_query'])) {
            $source = $update['callback_query'];
        } else if (isset($update['message'])) {
            $source = $update['message'];
        } else {
            $this->chat->html('Нет информации о пользователе.')->send();
            return;
        }

        $userId = $source['from']['id'];
        $firstName = $source['from']['first_name'];
        $lastName = $source['from']['last_name'] ?? null; // Используем ?? для обработки отсутствующих значений
        $username = $source['from']['username'] ?? null;

        // Находим или создаем пользователя
        $user = User::updateOrCreate(
            ['telegram_id' => $userId],
            ['first_name' => $firstName, 'last_name' => $lastName, 'username' => $username]
        );

        // Создаем анкету, если её нет
        Questionnaire::firstOrCreate(
            ['user_id' => $user->id],
            ['name' => $firstName, 'lastName' => $lastName, 'telegram_name' => $username]
        );

        Analytics::updateOrCreate(
            ['user_id' => $user->id],
            ['is_telegram_bot' => true]
        );

        $textHello = 'Добрый день! 

Чтобы ознакомиться с нашим методом, который позволяет достигать любых учебных целей на западе, подпишитесь на наш телеграм канал';

        $this->chat->html($textHello)->keyboard(Keyboard::make()->buttons([
            Button::make('Подписаться!')->url('https://t.me/foreignmath'),
        ]))->send();

        sleep(1);
        $this->chat->html('Давай проверим подписку?')->keyboard(Keyboard::make()->buttons([
            Button::make('Проверить подписку')->action("checked"),
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

    public function checked(): void
    {
        $update = json_decode(file_get_contents('php://input'), true);
        $app_url = env('APP_URL');

        // Получаем Telegram ID пользователя
        if (isset($update['callback_query'])) {
            $telegramId = $update['callback_query']['from']['id'];
        } elseif (isset($update['message'])) {
            $telegramId = $update['message']['from']['id'];
        } else {
            $this->chat->html('Нет информации о пользователе.')->send();
            return;
        }

        $token = env('TELEGRAM_TOKEN');
        $changeGroup = '@foreignmath';

        $urlChangeGroup = "https://api.telegram.org/bot$token/getChatMember?chat_id=$changeGroup&user_id=$telegramId";

        // Получаем статус пользователя в группе
        try {
            $response = file_get_contents($urlChangeGroup);
            $data = json_decode($response, true);
        } catch (\Exception $e) {
            $this->chat->html('Ошибка при выполнении запроса: ' . $e->getMessage())->send();
            return;
        }

        // Проверка на ошибки в ответе
        if (empty($data['ok'])) {
            $this->chat->html('Ошибка: ' . $data['description'])->send();
            return;
        }

        // Проверяем статус пользователя в канале
        if (isset($data['result']['status'])) {
            $status = $data['result']['status'];

            if (in_array($status, ['member', 'administrator', 'creator'])) {



                $userId = User::where('telegram_id', $telegramId)->first()->id;

                Analytics::updateOrCreate(
                    ['user_id' => $userId],
                    ['is_subscribed_telegram' => 1]
                );

                $this->chat->html('Спасибо, что подписались')->send();

                sleep(1);
                $text = 'Держите подробный разбор используемого нами метода, который позволяет повышать оценки с F до A...'; // Сокращенный текст

                $this->chat->html($text)->keyboard(Keyboard::make()->buttons([
                    Button::make('Забрать статью')->url("$app_url/$userId/article"),
                ]))->send();
            } else {
                User::with('analytics')->where('telegram_id', $telegramId)->update(['is_subscribed' => false]);
                $this->chat->html('Вы не подписались')->keyboard(Keyboard::make()->buttons([
                    Button::make('Подпишись на канал и забирай статью')->url('https://t.me/foreignmath'),
                ]))->send();
            }
        } else {
            $this->chat->html('Не удалось получить статус пользователя.')->send();
        }
    }


}