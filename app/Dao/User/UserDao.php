<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\User;

class UserDao implements UserDaoInterface
{
  /**
   * Get Operator List
   * @param Object
   * @return $operatorList
   */
  public function getUserList()
  {
    return User::get();
  }
}
