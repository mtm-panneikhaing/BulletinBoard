<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use App\Contracts\Services\Post\PostServiceInterface;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{   

    private $postInterface;

    public function __construct(PostServiceInterface $postInterface){

        $this->postInterface = $postInterface;
        $this->middleware('auth')->except(['detail']);
    }

    public function detail(){
        $postList = $this->postInterface->getPostList();
        return view('posts.post-list',[
            'posts' => $postList
        ]);
    }

    public function create( ){
        return view('posts.create-post');
    }

    public function insert(Request $request){
       
        $this->postInterface->insertPost($request);
        return redirect('/posts');

    }

    public function delete($id){
       
        $this->postInterface->deletePost($id);
        return redirect('/posts')
        ->with('info','Post  Deleted');

    }

    public function add(){
        return view('posts.add-post');
    }

    public function confirmPost(Request $request){

        $validator = validator(request()->all(),[
            'title' =>'required',
            'description' => 'required',
        ]);
        
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        return view('posts.create-post-confirmation',[
            'posts' => $request
        ]);
    }

    public function update($id){
        $updatePost = $this->postInterface->searchPost($id);
        return view('posts.update-post',[
            'post' => $updatePost 
        ]);
    }

    public function updateConfirm(Request $request){

        // $validator = validator(request()->all(),[
        //     'title' =>'required',
        //     'description' => 'required',
        // ]);
        
        // if($validator->fails()){
        //     return back()->withErrors($validator);
        // }

        return view('posts.update-post-confirmation',[
            'posts' => $request
        ]);
    }

    public function updatePost(Request $request){

        $this->postInterface->updatePost($request);
        return redirect('/posts');
    }

}
