<?php

// namespace App\Http\Controllers\UserController;
namespace App\Http\Controllers;
use App\Models\Analytics;
use App\Models\User;
use App\Models\Questionnaire;
use Illuminate\Http\Request;
use Log;
use Symfony\Component\Console\Question\Question;
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

    try {

      $user = User::where('id', $request->id);

      Questionnaire::where('user_id', $request->id)->update(
        [
          'name' => $request->name,
          'lastName' => $request->lastName,
          'age' => $request->age,
          'country' => $request->country,
          'phone' => $request->phone,
          'email' => $request->email,
          'tasks' => $request->tasks,
          'deadline' => $request->deadline,
          'investment' => $request->investment
        ]
      );

      Analytics::where('user_id', $request->id)->update(
        [
          "is_questionnaires_passed" => true
        ]
      );

      if ($user) {

        return response()->json([
          'data' => $user,
          'status' => '200',
        ]);
      } else {

        return response()->json([
          'data' => $user,
          'status' => '404',
        ]);
      }

    } catch (\Exception $e) {
      return response()->json([
        'data' => $e->getMessage(),
        'status' => '500',
      ]);
    }
  }

  public function update(Request $request, $id)
  {
    $user = User::find($id);

    $user->update($request->all());



    return response()->json([
      'data' => $user,
      'status' => '200',
    ]);
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
