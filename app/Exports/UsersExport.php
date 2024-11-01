<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Analytics;
use App\Models\Questionnaire;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return User::all()->map(function ($user) {
            $analytics = Analytics::where('user_id', $user->id)->first();
            $questionnaire = Questionnaire::where('user_id', $user->id)->first();

            return [
                'ID' => $user->id,
                'Ник Telegram' => $questionnaire->telegram_name,
                'Лендинг' => (string) $analytics->is_leanding,

  
                'Статья' => (string) $analytics->is_article,
                'Анкета' => (string) $analytics->is_questionnaires,
                'Отправил Анкету' => (string) $analytics->is_questionnaires_passed,

                'Календарь' => (string) $analytics->is_calendar,
                'Запись на консультацию' => (string) $analytics->is_calendar_passed,
                'Консультация проведена' => (string) $analytics->consultation_conducted,
                'Покупка курса' => (string) $analytics->purchase_of_course,
                'Оплачено всего, евр' => (string) $analytics->paid_in_total,
                "Дата создания" => $user->created_at
            ];
        });
    }
    public function headings(): array
    {
        return [
            'ID',
            'Ник Telegram',
            'Лендинг',
            'Telegram Bot',
            'Запись на канал',
            'Статья',
            'Анкета',
            'Отправил Анкету',
            'С оплатой',
            'Оплачено',
            'Календарь',
            'Запись на консультацию',
            'Консультация проведена',
            'Покупка курса',
            'Оплачено всего, евр',
            'Дата создания'
        ];
    }
}
