<?php
namespace App\Repositories\Criterias\Implement\Blog;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetBlogByBlogCategoryIdCriteria extends BaseCriteria
{
    private $_blog_category_id;

    /**
     * GetBlogByBlogCategoryIdCriteria constructor.
     * @param $blogCategoryId
     */
    public function __construct($blogCategoryId)
    {
        $this->_blog_category_id = $blogCategoryId;
    }

    public function apply($model, Repository $repository)
    {
        if (!empty($this->_blog_category_id)) {
            $model = $model->wherePivot('blog_category_id', $this->_blog_category_id);
        }

        return $model;
    }
}