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
    /** userInterface */
    private $userInterface;
    
    /**
     * constructor
     * @param userInterface
     */
    public function __construct(UserServiceInterface $userInterface){

        $this->userInterface = $userInterface;
        $this->middleware('auth');
    } 

    /**
     * User List 
     */
    public function userList(){

        $userList = $this->userInterface->getUserList();

        return view('users.users-list',[
            "users"=>$userList
        ]);
    }
    
    /**
     * Create user view
     */
    public function create(){
        return view('users.create-user');
    }

    /**
     * User confirmation 
     */
    public function userConfirm(Request $request){

        $validator = validator(request()->all(),[
            'name' =>'required',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'password_confirm' => 'required',
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

    /**
     * Insert user into database
     * @param $request
     */
    public function userInsert(request $request){

        $this->userInterface->userInsert($request);

        return redirect('/users/list')
                ->with('info','Created User');
    }
    
    /**
     * User Profile
     */
    public function userProfile(){
        return view('users.user-profile');
    }

    // public function userDetail(){
    //     return view('users.user-detail');
    // }

    /**
     * edit profile view
     */
    public function editProfile(){
        return view('users.edit-profile');
    }

    /**
     * User update confirmation
     * @param $request
     */
    public function updateConfirm(Request $request){

        $validator = validator(request()->all(),[
            'name' =>'required','unique:users',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'type' => 'required',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator);
        }else{

            $imageName = time().'.'.$request->profile->extension();  
            $request->profile->move(public_path('images'), $imageName);

            return view('users.user-update-confirm', [
                'user' => $request , 
                'profile' => $imageName
            ]);
        }
       
    }
    
    /**
     * Update user into database
     * @param $request
     */
    public function userUpdate(Request $request){

        $this->userInterface->updateUser($request);

        return redirect('/users/profile')
                ->with('info','Updated');
    }

    /**
     * Delete user 
     * @param $request
     */
    public function userDelete(Request $request){
        $id = request()->id;
        $this->userInterface->userDelete($id);
       
        return redirect()->back()
            ->with('info','User Deleted');
    }

    /**
     * Change password view
     */
    public function changePassword(){
        return view('users.change-password');
    }

    /**
     * Change password confirmation view
     */
    public function passwordConfirm(){
        return view('users.confirm-password');
    }

    /**
     * Change password  
     * @param $request
     */
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
                
                return  redirect('/users/profile')
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
    

    /**
     * search user
     * @param request
     */
    public function search(Request $request){

        $users = $this->userInterface->userSearch($request);
        return view('users.users-list',[
            "users"=>$users
        ]);
    }
}
