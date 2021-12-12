<?php
namespace App\Repositories\Criterias\Implement\Blog;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetBlogByBlogTagIdCriteria extends BaseCriteria
{
    private $_blog_tag_id;

    /**
     * GetBlogByTagIdCriteria constructor.
     * @param $blogTagId
     */
    public function __construct($blogTagId)
    {
        $this->_blog_tag_id = $blogTagId;
    }

    public function apply($model, Repository $repository)
    {
        if (!empty($this->_blog_tag_id)) {
            $model = $model->wherePivot('blog_tag_id', $this->_blog_tag_id);
        }

        return $model;
    }
}