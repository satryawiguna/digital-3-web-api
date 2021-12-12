<?php
namespace App\Repositories\Criterias\Implement\BlogTag;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetAllBlogTagCriteria extends BaseCriteria
{
    private $_keyword;

    /**
     * GetAllBlogTagCriteria constructor.
     * @param $keyword
     */
    public function __construct($keyword)
    {
        $this->_keyword = $keyword;
    }

    public function apply($model, Repository $repository)
    {
        if (!empty($this->_keyword)) {
            $model = $model->where('name', 'LIKE', '%' . $this->_keyword . '%')
                ->orWhere('slug', 'LIKE', '%' . $this->_keyword . '%');
        }

        return $model;
    }
}