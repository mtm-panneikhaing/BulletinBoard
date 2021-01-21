<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Input;

class PostController extends Controller
{

    /** $postInterface */
    private $postInterface;

    /**
     * constructor
     * @param postInterface
     * */
    public function __construct(PostServiceInterface $postInterface)
    {
        $this->postInterface = $postInterface;
    }

    /**
     * export csv file
     * @return excel file
     */
    public function export()
    {
        Excel::download(new PostsExport, 'posts.xlsx');
        return response()->json("dwonload successful");
    }

    /**
     * Upload link to view
     */
    public function upload()
    {
        return view("posts.post_upload");
    }

    /**
     * import csv file
     * @param request
     */
    public function import()
    {
        $validator = validator(request()->all(), [
            'file'=>'required', 'mimes:csv','size:max:500',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $path = request()->file('file');
        $import = new PostsImport;
        $import->import($path);
        
        if ($import->failures()->isNotEmpty()) {
            return back()->withFailures($import->failures());
        } else {
            return redirect('/posts');
        }
    }

    /**
     * post detail
     */
    public function detail(Request $request)
    {
        // $post = $this->postInterface->getPostList($request);
        $post=  Post::with('user')->where('deleted_user_id', null)->get();
        //$post = Post::all();
        return response()->json($post, 200);
    }

    /**
     * Go to view post add
     */
    public function add()
    {
        return view('posts.post_add');
    }

    /**
     * create post to view
     */
    public function create()
    {
        return view('posts.create-post');
    }

    /**
     * confirmPost
     * @param $request
     * @return $posts
     */
    public function confirmPost(Request $request)
    {
        $request->validate([
            'title' =>'required|unique:posts',
            'description' => 'required',
        ]);

        return response()->json($request, 200);
    }

    /**
     * insert post into database
     * @param request
     * @return info
     */
    public function insert(Request $request)
    {
        $this->postInterface->insertPost($request);
        return response()->json("Post Added");
    }

    /**
     * delete post
     * @param delete id
     * @return info
     */
    public function delete($id)
    {
        //$id = $request->id;
        //$this->postInterface->deletePost($request);
        $delete_id = Post::find($id);
        $delete_id -> status = 0;
        $delete_id -> deleted_at = now();
        $delete_id -> deleted_user_id = $id;
        $delete_id -> save();
        return response()->json("deleted");
    }

    // /**
    //  * search updated data in database
    //  * @param update $id
    //  * @return old data
    //  */
    // public function update($id)
    // {
    //     $updatePost = $this->postInterface->searchPost($id);
    //     return response()->json($updatePost, 200);
    // }

    /**
     * update confirmation
     * @return posts
     */
    public function updateConfirm(Request $request)
    {
        $request -> validate([
            'title' =>'required',
            'description' => 'required',
        ]);
        return response()->json($request, 200);
    }

    /**
     * update post into database
     * @param request
     */
    public function updatePost(Request $request)
    {
        // $post = $this->postInterface->updatePost($request);
        $post = Post::find($request->id);
        $post->title = $request->title;
        $post->description = $request->description;
        $post->updated_user_id = $request->userId;
        $data = $post->save();
        return response()->json($data, 200);
    }
}
