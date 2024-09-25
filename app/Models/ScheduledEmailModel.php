<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledEmailModel extends Model
{
    use HasFactory;
    protected $table = 'scheduled_emails';
    protected $fillable = [
        'recipient', // Email получателя
        'message',   // Содержимое сообщения
        'send_at',   // Дата и время отправки
    ];
}