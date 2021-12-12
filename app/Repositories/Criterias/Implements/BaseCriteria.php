<?php
namespace App\Repositories\Criterias\Implement;


use App\Repositories\Contract\IRepository as Repository;

abstract class BaseCriteria
{
    /**
     * BaseCriteria constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param $model
     * @param Repository $repository
     * @return mixed
     */
    public abstract function apply($model, Repository $repository);
}