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
     * import csv file
     * @param request
     */
    public function import(Request $request)
    {
        $request->validate([
            'import_file'=>'required|file|mimes:xls,xlsx,csv'
        ]);

        $path = $request->file("import_file");
        $import = new PostsImport;
        $request = $import->import($path);

        return response()->jsonn(['message' => 'uploaded successfully'], 200);
    }

    /**
     * post detail
     */
    public function detail()
    {
        $post = $this->postInterface->getPostList();
        return response()->json($post, 200);
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
        return response()->json();
    }

    /**
     * delete post
     * @param delete id
     * @return info
     */
    public function delete($id)
    {
        $this->postInterface->deletePost($id);
        return response()->json("deleted");
    }
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
        $this->postInterface->updatePost($request);
        
        return response()->json("updated");
    }
}
