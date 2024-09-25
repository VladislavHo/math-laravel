<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'payment_name',
        'status',
        'date_payment',
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
