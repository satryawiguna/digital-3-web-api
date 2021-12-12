<?php
namespace App\Repositories\Criterias\Implement\Role;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetAllRoleCriteria extends BaseCriteria
{
    private $_keyword;

    /**
     * GetAllRoleCriteria constructor.
     * @param $keyword
     */
    public function __construct($keyword)
    {
        $this->_keyword = $keyword;
    }

    public function apply($model, Repository $repository)
    {
        if (!empty($this->_keyword)) {
            $model = $model->where('role', 'LIKE', '%' . $this->_keyword . '%')
                ->orWhere('description', 'LIKE', '%' . $this->_keyword . '%');
        }

        return $model;
    }
}