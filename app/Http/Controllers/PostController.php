<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PostsExport;
use App\Imports\PostsImport;
/**
 * 
 * @author 
 */
class PostController extends Controller
{   

    /** $postInterface */
    private $postInterface;

    /**
     * constructor 
     * @param postInterface
     * */ 
    public function __construct(PostServiceInterface $postInterface){

        $this->postInterface = $postInterface;
        // $this->middleware('auth')->except(['detail']);
    }

    /**
     * export csv file
     */
    public function export(){
        
        return Excel::download(new PostsExport, 'posts.xlsx');
    }

    /**
     * Upload link to view
     */
    public function upload(){

        return view("posts.upload-post");

    }

    /**
     * import csv file
     * @param request
     */
    public function import(){

        $validator = validator(request()->all(),[
            'file'=>'required', 'mimes:csv','size:max:500',
            ]);
        
        if($validator->fails()){
            return back()->withErrors($validator);
        }else{

            $path = request()->file('file');
        
            Excel::import(new PostsImport, $path , 's3');
            return redirect('/posts')
                ->with('info','Upload successful');
        }

    }

    /**
     * post detail 
     */
    public function detail(){

        $postList = $this->postInterface->getPostList();
        return view('posts.post-list',[
            'posts' => $postList
        ]);
    }

    /**
     * Go to view post add
     */
    public function add(){

        return view('posts.add-post');
    }

    /**
     * create post to view
     */
    public function create( ){

        return view('posts.create-post');
    }

    /**
     * confirmPost
     * @param $request
     */
    public function confirmPost(Request $request){

        $validator = validator(request()->all(),[
            'title' =>'required|unique:posts',
            'description' => 'required',
        ]);
        
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        return view('posts.create-post-confirmation',[
            'posts' => $request
        ]);
    }

    /**
     * insert post into database
     * @param request
     */
    public function insert(Request $request){
       
        $this->postInterface->insertPost($request);
        return redirect('/posts')
            ->with('info','Add Post Successful');

    }

    /**
     * delete post
     * @param delete id
     */
    public function delete(Request $request){

        $id = request()->id;

        $this->postInterface->deletePost($id);
        return redirect('/posts')
        ->with('info','Post  Deleted');

    }


    /**
     * search updated data in database
     * @param update $id
     * return old data
     */
    public function update($id){

        $updatePost = $this->postInterface->searchPost($id);
        return view('posts.update-post',[
            'post' => $updatePost 
        ]);
    }

    /**
     * update confirmation
     */
    public function updateConfirm(Request $request){

        $validator = validator(request()->all(),[
            'title' =>'required',
            'description' => 'required',
        ]);
        
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        return view('posts.update-post-confirmation',[
            'posts' => $request
        ]);
    }
     
    /**
     * update post into database
     * @param request
     */
    public function updatePost(Request $request){

        $this->postInterface->updatePost($request);
        return redirect('/posts');
    }

    /**
     * search
     * @param search $request
     */
    public function search(Request $request){

        $posts = $this->postInterface->search($request);

        return view('posts.post-list',[
            'posts' => $posts
        ]);
    }

}
