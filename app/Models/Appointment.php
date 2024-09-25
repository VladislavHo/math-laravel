<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
class Appointment extends Model
{
    use HasFactory;

    protected $table = 'appointments';

    // Укажите атрибуты, которые могут быть присвоены массово
    protected $fillable = [
        'id',            // Идентификатор записи
        'user_id',       // Идентификатор пользователя
        'date',          // Дата консультации
        'time',          // Время консультации
        'status',        // Статус записи
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Генерируем UUID перед созданием записи
            $model->id = Uuid::uuid4()->toString();
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
