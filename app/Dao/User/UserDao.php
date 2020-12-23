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
    return User::latest()->paginate(5);
  }

 
  public function userInsert($request){
    //insert user into database
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

  //user delete
  public function userDelete($id)
  {
    $delete_id = User::find($id);
    $delete_id->type = 0;
    $delete_id->deleted_user_id =Auth::user()->id;
    $delete_id->save();
  }
}
