<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'telegram_name', 'name', 'lastName', 'country', 'phone', 'email', 'tasks', 'deadline', 'age', 'investment', 'answer'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
