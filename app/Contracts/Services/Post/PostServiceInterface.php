<?php

namespace App\Contracts\Services\Post;

interface PostServiceInterface
{
  //get Post list
  public function getPostList();
  
  //insert Post
  public function insertPost($request);

  //delete Post
  public function deletePost($id);

}
