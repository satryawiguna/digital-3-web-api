<?php
namespace App\Repositories\Criterias\Implement\BlogTag;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetBlogTagByNameCriteria extends BaseCriteria
{
    private $_keyword;

    /**
     * GetBlogTagByNameCriteria constructor.
     * @param $keyword
     */
    public function __construct($keyword)
    {
        $this->_keyword = $keyword;
    }

    public function apply($model, Repository $repository)
    {
        $model = $model->where('name', 'LIKE', '%' . $this->_keyword . '%');

        return $model;
    }
}