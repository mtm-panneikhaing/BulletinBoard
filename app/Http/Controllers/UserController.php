<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Contracts\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    private $userInterface;
    
    public function __construct(UserServiceInterface $userInterface){

        $this->userInterface = $userInterface;
        $this->middleware('auth');
    } 

    public function userList(){

        $userList = $this->userInterface->getUserList();

        return view('users.users-list',[
            "users"=>$userList
        ]);
    }
    
    public function create(){
        return view('users.create-user');
    }

    public function userConfirm(request $request){

        $validator = validator(request()->all(),[
            'name' =>'required',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'password_confirm' => 'required',
            'type' => 'required',
            'phone' => 'required',
            'dob' => 'required',
            'address' => 'required',
            // 'profile' => 'image|mimes:jpeg,jpg,png|size:2000',
        ]);

        // $destinationPath = 'images/'; // upload path
        // $profileImage = time() . "." . $files->getClientOriginalExtension();
        // $files->move($destinationPath, $profileImage);

        // $imageName = time().'.'.request()->profile->extension();  
   
        // $request->image->move(public_path('images'), $imageName);
        request()->validate([ 

            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

  

        $imageName = time().'.'.request()->profile->getClientOriginalExtension();

  

        request()->image->move(public_path('images'), $imageName);


        return view('users.confirm-user',[
            'users' => $request,
            'profile' => $imageName,
        ]);
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

    //user delete
    public function userDelete( ){
        return view('users.user-delete');
    }

    public function changePassword(){
        return view('users.change-password');
    }

    public function passwordConfirm(){
        return view('users.confirm-password');
    }
}
