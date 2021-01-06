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

    /**
     * Insert Post
     * @param Request
     * @return
     */
    public function insertPost($request)
    {
        return $this->postDao->insertPost($request);
    }

    /**
     * Delete Post
     * @param Post Id
     * @return
     */
    public function deletePost($id)
    {
        return $this->postDao->deletePost($id);
    }

    /**
     * Search Posts
     * @param Post Id
     * @return
     */
    public function searchPost($id)
    {
        return $this->postDao->searchPost($id);
    }

    /**
     * Update Post
     * @param Request
     * @return
     */
    public function updatePost($request)
    {
        return $this->postDao->updatePost($request);
    }

    /**
     * Search Post
     * @param Request
     * @return
     */
    public function search($request)
    {
        return $this->postDao->search($request);
    }
}
