<?php
namespace App\Repositories\Criterias\Implement\ProductTag;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetProductTagByNameCriteria extends BaseCriteria
{
    private $_name;

    /**
     * GetProductTagByNameCriteria constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->_name = $name;
    }

    public function apply($model, Repository $repository)
    {
        $model = $model->where('name', 'LIKE', '%' . $this->_name . '%');

        return $model;
    }
}