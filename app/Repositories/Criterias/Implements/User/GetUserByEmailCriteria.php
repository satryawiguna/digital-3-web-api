<?php
namespace App\Repositories\Criterias\Implement\User;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetUserByEmailCriteria extends BaseCriteria
{
    private $_keyword;

    /**
     * GetUserByEmailCriteria constructor.
     * @param $keyword
     */
    public function __construct($keyword)
    {
        $this->_keyword = $keyword;
    }

    public function apply($model, Repository $repository)
    {
        $model = $model->where('email', 'LIKE', '%' . $this->_keyword . '%');

        return $model;
    }
}