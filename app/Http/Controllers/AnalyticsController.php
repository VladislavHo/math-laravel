<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
class AnalyticsController
{
  public function checekArticle(Request $request)
  {
    $user_id = $request->id;
    $user = User::with('analytics')->where('id', $user_id)->first()->analytics()->update(['is_article' => true]);
    if ($user) {
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
    $user = User::with('analytics')->where('id', $user_id)->first()->analytics()->update(['is_questionnaires' => true]);
    if ($user) {
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
    $user = User::with('analytics')->where('id', $user_id)->first()->analytics()->update(['is_pay' => $is_pay]);
    if ($user) {
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
    $user = User::with('analytics')->where('id', $user_id)->first()->analytics()->update(['is_calendar' => true]);
    if ($user) {
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