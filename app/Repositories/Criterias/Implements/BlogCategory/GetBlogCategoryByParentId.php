<?php
namespace App\Repositories\Criterias\Implement\BlogCategory;

use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetBlogCategoryByParentId extends BaseCriteria
{
    private $_parent_id;

    /**
     * GetBlogCategoryByParentId constructor.
     * @param $parentId
     */
    public function __construct($parentId)
    {
        $this->_parent_id = $parentId;
    }

    public function apply($model, Repository $repository)
    {
        $model = $model->where('parent_id', ($this->_parent_id <> 0) ? $this->_parent_id : null);

        return $model;
    }
}