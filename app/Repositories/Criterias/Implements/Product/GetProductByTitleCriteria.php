<?php
namespace App\Repositories\Criterias\Implement\Product;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetProductByTitleCriteria extends BaseCriteria
{
    private $_title;

    /**
     * GetProductByTitleCriteria constructor.
     * @param $title
     */
    public function __construct($title)
    {
        $this->_title = $title;
    }

    public function apply($model, Repository $repository)
    {
        $model = $model->where('title', 'LIKE', '%' . $this->_title . '%');

        return $model;
    }
}