<?php

namespace App\Dao\User;

use App\Contracts\Dao\User\UserDaoInterface;
use App\User;
use Auth;

class UserDao implements UserDaoInterface
{
    /**
     * Get Operator List
     * @param Object
     * @return $operatorList
     */
    public function getUserList()
    {
        return User::with('user')->where('deleted_user_id', null)->get();
    }

    /**
     * Insert User
     *@param $request
     */
    public function userInsert($request)
    {
        $exploded = explode(',', $request->profile);
        $decoded = base64_decode($exploded[1]);
        if (str_contains($exploded[0], 'jpeg')) {
            $extension = 'jpg';
        } else {
            $extension = 'png';
        }
        $fileName = time().'.'.$extension;
        $path = public_path().'/images/'.$fileName;
        file_put_contents($path, $decoded);
        
        $user = new User;
        $user -> name = $request -> name;
        $user -> email = $request -> email;
        $user -> type = $request -> type;
        $user -> password = bcrypt($request -> password);
        $user -> profile = $fileName;
        
        $user -> create_user_id = Auth::user()->id;
        $user -> updated_user_id = Auth::user()->id;
     
        $user->save();
    }

    /**
     * User Update
     * @param $request
     */
    public function updateUser($request)
    {
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;


        if ($request->profile) {
            $exploded = explode(',', $request->profile);
            $decoded = base64_decode($exploded[1]);
            if (str_contains($exploded[0], 'jpeg')) {
                $extension = 'jpg';
            } else {
                $extension = 'png';
            }
            $fileName = time().'.'.$extension;
            $path = public_path().'/images/'.$fileName;
            file_put_contents($path, $decoded);
            $user->profile = $profile;
        }

        
        $user ->updated_user_id = Auth::user()->id;
        $user ->updated_user_id = Auth::user()->id;
        $user->updated_at = now();
        return $user->save();
    }

    /**
     * User Delete
     * @param $id user id
     */
    public function userDelete($id)
    {
        $delete_id = User::find($id);
        $delete_id->deleted_user_id = Auth::user()->id;
        $delete_id->deleted_at = now();
        $delete_id->save();
    }

    /**
     * Password Change
     * @param $password
     */
    public function passwordChange($password)
    {
        Auth::user()->password = bcrypt($password);
        Auth::user()->updated_user_id = Auth::user()->id;
        Auth::user()->updated_at = now();
        Auth::user()->save();
    }

    /**
     * Search User
     * @param request
     * @return searched user list
     */
    public function userSearch($request)
    {
        return User::where('name', 'LIKE', '%' . $request->name . '%')
            ->where('email', 'LIKE', '%' . $request->email . '%')
            ->where('created_at', 'LIKE', '%' . $request->createFrom . '%')
            ->where('updated_at', 'LIKE', '%' . $request->createTo . '%')
            ->where('deleted_user_id')
            ->latest()->paginate(5);
    }
}
