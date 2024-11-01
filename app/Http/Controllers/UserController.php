<?php

// namespace App\Http\Controllers\UserController;
namespace App\Http\Controllers;

use App\Models\Analytics;
use App\Models\User;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class UserController
{
  //


  public function index()
  {
    $users = User::all();
    return response()->json([
      'data' => $users,
      'status' => '200',
    ]);
  }


  public function create(Request $request)
  {
    $pages = $request->pages;
    $id = $request->id;



    $user = User::where('id', $id)->first();

    if($user) {

      $analytics = $user->analytics();


      if($analytics) {
        $analytics->update([
          $pages => 1,
        ]);

        return response()->json([
          'data' => $user,
          'status' => '200',
          'message' => 'Пользователь обновлен',
        ]);
      }
    }


    $newUser = User::create();

    if($newUser) {



     $analytics = Analytics::updateOrCreate(
      ['user_id' => $newUser->id],
      [$pages => 1]
  );



      return response()->json([
        'data' => $newUser,
        'status' => '200',
        'message' => 'Пользователь создан',
      ]);
    }


    return response()->json([
      'data' => null,
      'status' => '400',
      'message' => 'Пользователь не создан',
    ]);

  }


  public function update(Request $request)
  {
      try {
          // Поиск пользователя по ID
          $user = User::find($request->id);
  
  
          // Обновление анкеты
         Questionnaire::updateOrCreate(
              ['user_id' => $user->id],
              [
                  'name' => $request->name,
                  'lastName' => $request->lastName,
                  'age' => $request->age,
                  'country' => $request->country,
                  'phone' => $request->phone,
                  'email' => $request->email,
                  'tasks' => $request->tasks,
                  'deadline' => $request->deadline,
                  'investment' => $request->investment,
                  'telegram_name' => $request->telegram_name ? str_replace('@', '', $request->telegram_name) : null,
              ]
          );
  
          // Обновление аналитики
          Analytics::where('user_id', $user->id)->update([
              "is_questionnaires_passed" => true
          ]);
  
          // Возврат успешного ответа
          return response()->json([
              'data' => $user,
              'status' => '200',
          ]);
      } catch (\Exception $e) {
          return response()->json([
              'data' => $e->getMessage(),
              'status' => '500',
          ]);
      }
  }

  public function getAppointmentsByUser(Request $request)
  {
    $user = User::with('appointments')->find($request->id);
    return response()->json([
      'data' => $user->appointments,
      'status' => '200',
    ]);
  }
}
