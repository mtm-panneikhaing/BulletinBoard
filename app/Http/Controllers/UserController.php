<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function userList(){
        return view('users.users-list');
    }
    
    public function create(){
        return view('users.create-user');
    }

    public function userConfirm(){
        return view('users.confirm-user');
    }
    
    public function userProfile(){
        return view('users.user-profile');
    }

    public function userDetail(){
        return view('users.user-detail');
    }

    public function userUpdate(){
        return view('users.user-update');
    }

    public function editProfile(){
        return view('users.edit-profile');
    }

    // user delete
    // public function userDelete( ){
    //     return view('users.user-delete');
    // }

    public function changePassword(){
        return view('users.change-password');
    }

    public function passwordConfirm(){
        return view('users.confirm-password');
    }
}
