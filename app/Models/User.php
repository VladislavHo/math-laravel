<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Ramsey\Uuid\Uuid;
class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $keyType = 'string'; // Указываем, что тип ключа — строка
    public $incrementing = false;   // Отключаем автоинкремент
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'lastName',
        'email',
        'phone',
        'email_verified_at',
        'tasks',
        'deadline',
        'plans',
        'age',
        'income',
        'appointment_id',
        'telegram_id',

        // 'password',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function questionnaire()
    {
        return $this->hasOne(Questionnaire::class);
    }

    public function analytics()
    {
        return $this->hasOne(Analytics::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            // Генерируем UUID перед созданием записи
            $model->id = Uuid::uuid4()->toString();
        });
    }
}
