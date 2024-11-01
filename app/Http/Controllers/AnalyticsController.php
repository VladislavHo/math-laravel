<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Log;
class AnalyticsController
{


  public function checekCalendar(Request $request)
  {
    $user_id = $request->id;
    $user = User::with('analytics')->where('id', $user_id)->first();
    $questionnaire = $user->questionnaire;
    if ($user && $user->analytics && $questionnaire) {
      // Обновляем поле is_article
      $user->analytics()->update(['is_calendar' => true]);

      return response()->json([
        'status' => 200,
        'message' => 'Пользователь обновлен',
      ]);
    }

    return response()->json([
      'status' => 400,
      'message' => 'Пользователь не обновлен',
    ]);
  }


}