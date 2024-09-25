<?php

// namespace App\Http\Controllers\UserController;
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
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
      $user = User::create($request->all());
      // $phone = $request->phone;
      // $email = $request->email;
      // $userPhone = User::where('phone', $phone)->first();
      // $userEmail = User::where('email', $email)->first();
      // if ($userPhone) {
      //   $userPhone->update([
      //     'phone' => $phone,
      //   ]);
      // }

      // if ($userEmail) {
      //   $userEmail->update([
      //     'email' => $email,
      //   ]);
      // }



      return response()->json([
        'data' => $user,
        'status' => '200',
      ]);
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
