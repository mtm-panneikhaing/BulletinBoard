<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;

use App\Post;

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
    $post -> create_user_id = 1;
    $post -> updated_user_id = 1;
    $post -> deleted_user_id = 1;
    $post -> created_at = now();
    $post -> updated_at = now();
    $post -> save();

  }

  public function deletePost($id){
    $delete_id = Post::find($id);
    $delete_id->status = 0;
    $delete_id->save();
  }

}
