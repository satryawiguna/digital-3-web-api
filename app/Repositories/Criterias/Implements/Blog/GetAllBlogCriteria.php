<?php
namespace App\Repositories\Criterias\Implement\Blog;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetAllBlogCriteria extends BaseCriteria
{
    private $_keyword;

    /**
     * GetAllBlogCriteria constructor.
     * @param $keyword
     */
    public function __construct($keyword)
    {
        $this->_keyword = $keyword;
    }

    public function apply($model, Repository $repository)
    {
        if (!empty($this->_keyword)) {
            $model = $model->where('title', 'LIKE', '%' . $this->_keyword . '%');
        }

        return $model;
    }
}