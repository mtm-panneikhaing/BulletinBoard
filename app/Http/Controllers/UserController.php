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
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            if($request->password == $request->password_confirm){
                $imageName = time().'.'.$request->profile->extension();  
                $request->profile->move(public_path('images'), $imageName);

                return view('users.confirm-user',[
                    'user' => $request,
                    'profile' => $imageName,
                ]);
            }else{
                return back()->withErrors('Comfirm Password');
            }
        }

    }

    public function userInsert(request $request){
        $this->userInterface->userInsert($request);

        return redirect('/users/list')
                ->with('info','Created User');
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
    public function delete($id){

        $this->userInterface->userDelete($id);
        
        return redirect()->back()
            ->with('info','User Deleted');
    }

    public function changePassword(){
        return view('users.change-password');
    }

    public function passwordConfirm(){
        return view('users.confirm-password');
    }
}
