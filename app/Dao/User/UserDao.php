<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\User;
use Auth;

class UserDao implements UserDaoInterface
{
  /**
   * Get Operator List
   * @param Object
   * @return $operatorList
   */
  public function getUserList()
  {
    return User::where('type','<=',2)->latest()->paginate(5);
  }

 /**
  * Insert User
  *@param $request
  */
  public function userInsert($request){
    $user = new User;
    $user -> name = request() -> name;
    $user -> email = request() -> email;
    $user -> password = bcrypt(request() -> password);
    $user -> profile = request() -> profile;
    $user -> dob = request() -> dob;
    $user -> phone = request() -> phone;
    $user -> address = request() -> address;
    $user -> create_user_id = Auth::user()->id;
    $user -> updated_user_id = Auth::user()->id;
    $user -> deleted_user_id =  null;
    $user -> created_at = now();
    $user -> updated_at = now();
    $user -> deleted_at = null;
    $user->save();
  }

  /**
   * User Update
   * @param $request 
   */
  public function updateUser($request)
  {
    $user = User::find($request->id);
    $user->name = $request->name;
    $user->email = $request->email;
    $user->profile = $request->profile;
    $user->type = $request->type;
    $user->phone = $request->phone;
    $user->address = $request->address;
    $user->updated_at = now();

    return $user->save();
  }

  /**
   * User Delete
   * @param $id user id
   */
  public function userDelete($id)
  {
    $delete_id = User::find($id);
    $delete_id->type = 3;
    $delete_id->deleted_user_id = Auth::user()->id;
    $delete_id->deleted_at = now();
    $delete_id->save();
  }

  /**
   * Password Change 
   * @param $password
   */
  public function  passwordChange($password){
    Auth::user()->password = bcrypt($password);
    Auth::user()->save();
  }
}
