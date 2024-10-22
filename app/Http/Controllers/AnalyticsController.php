<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Log;
class AnalyticsController
{
  public function checekArticle(Request $request)
  {
    $user_id = $request->id;

    // Получаем пользователя с его аналитикой
    $user = User::with('analytics')->where('id', $user_id)->first();

    // Проверяем, найден ли пользователь и существует ли у него аналитика
    if ($user && $user->analytics) {
      // Обновляем поле is_article
      $user->analytics()->update(['is_article' => true]);

      return response()->json([
        'status' => 'success',
        'message' => 'Пользователь обновлен',
      ]);
    }

    return response()->json([
      'status' => 'error',
      'message' => 'Пользователь не обновлен',
    ]);
  }

  public function checekQuestionnaire(Request $request)
  {
    $user_id = $request->id;
    $user = User::with('analytics')->where('id', $user_id)->first();
    if ($user && $user->analytics) {
      // Обновляем поле is_article
      $user->analytics()->update(['is_questionnaires' => true]);

      return response()->json([
        'status' => 'success',
        'message' => 'Пользователь обновлен',
      ]);
    }

    return response()->json([
      'status' => 'error',
      'message' => 'Пользователь не обновлен',
    ]);
  }


  public function checekIsPay(Request $request)
  {
    $user_id = $request->id;
    $is_pay = $request->is_pay;
    $user = User::with('analytics')->where('id', $user_id)->first();
    if ($user && $user->analytics) {
      // Обновляем поле is_article
      $user->analytics()->update(['is_pay' => $is_pay]);

      return response()->json([
        'status' => 'success',
        'message' => 'Пользователь обновлен',
      ]);
    }

    return response()->json([
      'status' => 'error',
      'message' => 'Пользователь не обновлен',
    ]);
  }


  public function checekCalendar(Request $request)
  {
    $user_id = $request->id;
    $user = User::with('analytics')->where('id', $user_id)->first();
    if ($user && $user->analytics) {
      // Обновляем поле is_article
      $user->analytics()->update(['is_calendar' => true]);

      return response()->json([
        'status' => 'success',
        'message' => 'Пользователь обновлен',
      ]);
    }

    return response()->json([
      'status' => 'error',
      'message' => 'Пользователь не обновлен',
    ]);
  }


}