<?php

namespace App\Contracts\Dao\Post;

interface PostDaoInterface
{
    //get post list 
    public function getPostList();

    //insert Post
    public function insertPost($request);

    //delete Post
    public function deletePost($id);

    //search Post
    public function searchPost($id);

    //update Post
    public function updatePost($request);
}
