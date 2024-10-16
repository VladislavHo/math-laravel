<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Analytics extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_learning',
        'is_telegram_bot',
        'is_subscribed_telegram',
        'is_article',
        'is_questionnaires',
        'is_questionnaires_passed',
        'is_calendar',
        'is_calendar_passed',
        'is_pay',
        'is_payment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
