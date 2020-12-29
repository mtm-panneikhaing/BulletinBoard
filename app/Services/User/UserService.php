<?php

namespace App\Services\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\User\UserServiceInterface;

class UserService implements UserServiceInterface
{
  private $userDao;

  /**
   * Class Constructor
   * @param OperatorUserDaoInterface
   * @return
   */
  public function __construct(UserDaoInterface $userDao)
  {
    $this->userDao = $userDao;
  }

  /**
   * Get User List
   * @param Object
   * @return $userList
   */
  public function getUserList()
  {
    return $this->userDao->getUserList();
  }

  //insert user
  public function userInsert($request)
  {
    return $this->userDao->userInsert($request);
  }

  //delete user
  public function userDelete($id)
  {
    return $this->userDao->userDelete($id);
  }

  //password change
  public function  passwordChange($password)
  {
    return $this->userDao->passwordChange($password);
  }

  //update user
  public function updateUser($request){
    return $this->userDao->updateUser($request);
  }

  public function userSearch($request)
  {
    return $this->userDao->userSearch($request);
  }
}
