<?php
namespace App\Repositories\Criterias\Implement\Auth;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class ActiveStatus extends BaseCriteria
{
    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public function apply($model, Repository $repository)
    {
        $model = $model->where('status', '=', 1);

        return $model;
    }

}