<?php

namespace App\Contracts\Services\User;

interface UserServiceInterface
{
  //get user list
  public function getUserList();

  //user insert
  public function userInsert($request);

  //user delete
  public function userDelete($id);

  //password change
  public function  passwordChange($password);
}
