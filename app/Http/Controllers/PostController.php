<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function detail( ){
        $posts = Post::latest()->paginate(5);
          return view('posts.post-list',[
            'posts' => $posts
        ]);
    }

    public function create( ){
        return view('posts.create-post');
    }

    public function insert( ){
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
        return redirect('/posts');
         
    }

    public function add( ){
        return view('posts.add-post');
    }

    public function confirmPost(Request $request){
       return view('posts.create-post-confirmation',[
           'posts' => $request
       ]);
    }

    public function update(){
        return view('posts.update-post');
    }
}
