<?php

namespace App\Dao\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
        $user = Auth::user();
        // all active post
        $activePost = Post::with('user')->where('status', 1)->get();
        // inactive but not deleted
        $inactivePost = Post::with('user')->where('status', 0)
                        ->where('create_user_id', Auth::id())
                        ->where('deleted_user_id', null)->get();

        $postList = $activePost->merge($inactivePost);
        return $postList;
    }

    /**
     * Insert Post
     * @param request
     */
    public function insertPost($request)
    {
        //insert Post into database
        $post = new Post;
        $post -> title = $request -> title;
        $post -> description = $request -> description;
        $post -> status = 1;
        $post -> create_user_id = Auth::user()->id;
        $post -> updated_user_id =Auth::user()->id;
        $post -> created_at = now();
        $post -> updated_at = now();
        return $post -> save();
    }

    /**
     * Delete Post
     * @param id
     */
    public function deletePost($id)
    {
        $delete_id = Post::find($id);
        $delete_id -> status = 0;
        $delete_id->deleted_user_id = Auth::user()->id;
        $delete_id -> deleted_at = now();
        $delete_id -> save();
    }

    /**
     * Search Id for Update
     * @param id
     * @return Object
     */
    public function searchPost($id)
    {
        return $search_id = Post::find($id);
    }

    /**
     * Update Post
     * @param request
     */
    public function updatePost($request)
    {
        $updatePost = Post::find($request->id);
        $updatePost->title = $request->title;
        $updatePost->description = $request->description;
        $updatePost->status = $request->status;
        $updatePost->create_user_id = Auth::id();
        $updatePost->updated_user_id = Auth::id();
        $updatePost->updated_at = now();
        $updatePost->save();
        return $updatePost;
    }

    /**
     * paginate
     * @param items
     * @return
     */
    public function pagination($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
