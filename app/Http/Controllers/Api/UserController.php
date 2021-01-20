<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use App\Contracts\Services\User\UserServiceInterface;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //** userInterface */
    private $userInterface;
    
    /**
     * constructor
     * @param userInterface
     */
    public function __construct(UserServiceInterface $userInterface)
    {
        $this->userInterface = $userInterface;
        // $this->middleware('auth');
    }

    /**
     * User List
     * @return users
     */
    public function userList()
    {
        // $user= $this->userInterface->getUserList();
        $user = User::all();
        return response()->json($user, 200);
    }
    
    /**
     * Create user view
     */
    public function create()
    {
        return view('users.user_create');
    }

    /**
     * User confirmation
     * @return uers,profile
     */
    public function userConfirm(Request $request)
    {
        // $validator = validator(request() -> all(), [
        //     'name' => 'required',
        //     'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
        //     'password' => 'required', 'string', 'min:8', 'confirmed',
        //     'password_confirm' => 'required',
        //     'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // if ($validator->fails()) {
        //     return back()->withErrors($validator);
        // }
        // if ($request->password == $request->password_confirm) {
        //     $imageName = time()  . '.' . $request->profile->extension();
        //     $request->profile->move(public_path('images'), $imageName);

        //     //require $imageName for details
        //     return response()->json($request);
        // }
        // return back()->withErrors('Comfirm Password');
        return response()->json($request);
    }

    /**
     * Insert user into database
     * @param $request
     * @return info
     */
    public function userInsert(request $request)
    {
        $this->userInterface->userInsert($request);
        return request().json("User Successfully Added");
    }
    
    /**
     * User Profile
     */
    public function userProfile()
    {
        return view('users.user_profile');
    }

    /**
     * edit profile view
     */
    public function editProfile()
    {
        return view('users.user_edit_profile');
    }

    /**
     * User update confirmation
     * @param $request
     * @return user,profile
     */
    public function updateConfirm(Request $request)
    {
        // $imageName = Auth::user()->profile;

        // $validator = validator(request()->all(), [
        //     'name' =>'required','unique:users',
        //     'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
        //     'type' => 'required',
        //     'profile' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // if ($validator->fails()) {
        //     return back()->withErrors($validator);
        // }
        // if ($request->hasFile('profile')) {
        //     $file = $request->file('profile');
        //     $imageName = time().'.'.$file->extension();
        //     $request->profile->move(public_path('images'), $imageName);
        // }
        // return view('users.user_update_confirm', [
        //     'user' => $request ,
        //     'profile' => $imageName
        // ]);

        return response()->json($request);
    }

    /**
     * Update user into database
     * @param $request
     * @return info
     */
    public function update(Request $request)
    {
        $this->userInterface->updateUser($request);

        return response()->json("update successful");
    }

    /**
     * Delete user
     * @param $request
     * @return info
     */
    public function userDelete(Request $request)
    {
        $id = $request->id;
        $this->userInterface->userDelete($id);
        return request().json();
    }

    /**
     * Change password view
     */
    public function changePassword()
    {
        return view('users.change_password');
    }

    /**
     * Change password confirmation view
     */
    public function passwordConfirm()
    {
        return view('users.confirm_password');
    }

    /**
     * Change password
     * @param $request
     * @return info
     */
    public function passwordChange(Request $request)
    {
        $validator = validator(request()->all(), [
            "old_password" =>'required',
            "new_password" =>'required|string|min:6',
            "con_new_password" =>'required',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $user = User::find(1);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->updated_user_id = 1;
            $user->updated_at = now();
            $result = $user->save();
            return response()->json($result, 200);
        }
    }
    
    /**
     * search user
     * @param request
     * @return users
     */
    public function search(Request $request)
    {
        $users = $this->userInterface->userSearch($request);
        return view('users.users_list', [
            "users" => $users
        ]);
    }
}
