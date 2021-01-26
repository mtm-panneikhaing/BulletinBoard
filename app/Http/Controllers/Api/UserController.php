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
    }

    /**
     * User List
     * @return users
     */
    public function userList()
    {
        $user= $this->userInterface->getUserList();
        return response()->json($user, 200);
    }

    /**
     * User confirmation
     * @return uers,profile
     */
    public function userConfirm(Request $request)
    {
        $request -> validate([
            'name' => 'required',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'password_confirm' => 'required|same:password',
            'profile' => 'required',
        ]);
        return response()->json($request, 200);
    }

    /**
     * Insert user into database
     * @param $request
     * @return info
     */
    public function userInsert(request $request)
    {
        $this->userInterface->userInsert($request);
        return response()->json("User Successfully Added");
    }
    
    /**
     * User update confirmation
     * @param $request
     * @return user,profile
     */
    public function updateConfirm(Request $request)
    {
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
    public function userDelete($id)
    {
        $this->userInterface->userDelete($id);
        return request()->json("Delete User Successful");
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
            "con_new_password" =>'required|same:new_password',

        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $user = User::find(1);
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->new_password);
            $user->updated_user_id = Auth::user()->id;
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
