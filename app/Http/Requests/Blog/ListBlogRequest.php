<?php
namespace App\Http\Requests\Blog;


use App\Http\Requests\Request;

class ListBlogRequest extends Request
{
    // Default Property

    public $blog_category_id;

    public $blog_tag_id;

    /**
     * @return mixed
     */
    public function getBlogCategoryId()
    {
        return $this->blog_category_id;
    }

    /**
     * @param mixed $blog_category_id
     */
    public function setBlogCategoryId($blog_category_id)
    {
        $this->blog_category_id = $blog_category_id;
    }

    /**
     * @return mixed
     */
    public function getBlogTagId()
    {
        return $this->blog_tag_id;
    }

    /**
     * @param mixed $blog_tag_id
     */
    public function setBlogTagId($blog_tag_id)
    {
        $this->blog_tag_id = $blog_tag_id;
    }

}