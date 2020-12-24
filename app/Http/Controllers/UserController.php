<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use App\Contracts\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Hash;
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
    public function delete(Request $request){
        $id = request()->id;
        $this->userInterface->userDelete($id);
       
        return redirect()->back()
            ->with('info','User Deleted');
    }

    public function changePassword(){
        return view('users.change-password');
    }

    public function passwordChange(Request $request){

        $validator = validator(request()->all(),[
            "old_password" =>'required',
            "new_password" =>'required|string|min:6',
            "con_new_password" =>'required',

        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }else{
            if (Hash::check($request->old_password, Auth::user()->password)) {
                // The old password matches the hash in the database
                if((request()->new_password == request()->con_new_password) &&
                    (request()->old_password != request()->new_password)){

                //update password into database
                $password = request()->new_password;
                $this->userInterface->passwordChange($password);
                
                return redirect('users/detail')
                                ->with('info','Password Changed');

                }else{
                     return back()->withErrors('Comfirm Password');
                } 
            }
            else{
                return back()->withErrors('Comfirm Password');
            }
        }
    }
    public function passwordConfirm(){
        return view('users.confirm-password');
    }
}
