<?php

namespace App\Services\Post;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;

class PostService implements PostServiceInterface
{
  private $postDao;

  /**
   * Class Constructor
   * @param OperatorPostDaoInterface
   * @return
   */
  public function __construct(PostDaoInterface $postDao)
  {
    $this->postDao = $postDao;
  }

  /**
   * Get Post List
   * @param Object
   * @return $PostList
   */
  public function getPostList()
  {
    return $this->postDao->getPostList();
  }

  //insert post
  public function insertPost($request)
  {
    return $this->postDao->insertPost($request);
  }

  //delete post
  public function deletePost($id)
  {
    return $this->postDao->deletePost($id);
  }

  //search post
  public function searchPost($id)
  {
    return $this->postDao->searchPost($id);
  }

  //update post
  public function updatePost($request)
  {
    return $this->postDao->updatePost($request);
  }
}
