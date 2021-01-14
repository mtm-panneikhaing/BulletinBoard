<?php
 
class note extends contorller
{
    public function index()
    {
        return Category::all();
    }

    public function store()
    {
        $category = new Category;
    }
}
