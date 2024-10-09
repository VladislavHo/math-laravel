<?php

// namespace App\Http\Controllers\UserController;
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Log;
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
      // $user = User::create($request->all());

      // $user = User::where('telegram_id', $request->all());


      $user = User::where('id', $request->id)->update($request->all());
      // $user = User::find($request->telegram_id);


      // Log::info($user . 'response data ' . $request->all());

      Log::info($request->all());


      if ($user) {
        return response()->json([
          'data' => $user,
          'status' => '200',
        ]);
      }else{

        return response()->json([
          'data' => $user,
          'status' => '404',
        ]);
      }

    } catch (\Exception $e) {
      \Log::error($e->getMessage());
      return response()->json([
        'data' => $e->getMessage(),
        'status' => '500',
      ]);
    }
  }

  public function update(Request $request, $id)
  {
    $user = User::find($id);
    // $user->update($request);

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
