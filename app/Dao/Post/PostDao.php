<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;

use App\Post;
use Auth;

class PostDao implements PostDaoInterface
{
  /**
   * Get Operator List
   * @param Object
   * @return $operatorList
   */

  public function getPostList()
  {
    // return Post::get();
    return Post::where('status',1)->latest()->paginate(5);
  }

  public function insertPost($request)
  {
    //insert Post into database
    $post = new Post;
    $post -> title = request() -> title;
    $post -> description = request() -> description;
    $post -> status = 1;
    $post -> create_user_id = Auth::user()->id;
    $post -> updated_user_id = Auth::user()->id;
    $post -> deleted_user_id = Auth::user()->id;
    $post -> created_at = now();
    $post -> updated_at = now();
    $post -> save();

  }

  public function deletePost($id)
  {
    $delete_id = Post::find($id);
    $delete_id->status = 0;
    $delete_id->deleted_user_id =Auth::user()->id;
    $delete_id->save();
  }

  //search for update
  public function searchPost($id)
  {
    return $search_id = Post::find($id);
  }

  //update post
  public function updatePost($request)
  {
    $post = Post::find($request->id);
    $post->title = $request->title;
    $post->description = $request->description;
    return $post->save();

  }
  /**
   * 
   */
  public function search($request)
  {
    // $post = new Post;    
    return Post::where('title', 'LIKE','%' . request()->search . '%')
                ->orwhere('description',  'LIKE','%' . request()->search . '%')
                ->join('users' , 'posts.create_user_id', '=','users.id')
                ->orwhere('users.name',  'LIKE','%' . request()->search . '%')
                ->latest('posts.created_at')->paginate(5);
  }

}
