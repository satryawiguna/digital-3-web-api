<?php
namespace App\Repositories\Criterias\Contracts;


use App\Repositories\Criterias\Implement\BaseCriteria as Criteria;

interface ICriteria
{
    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true);

    /**
     * @return mixed
     */
    public function getCriteria();

    /**
     * @param Criteria $criteria
     * @return mixed
     */
    public function getByCriteria(Criteria $criteria);

    /**
     * @param Criteria $criteria
     * @return mixed
     */
    public function pushCriteria(Criteria $criteria);

    /**
     * @return $this
     */
    public function  applyCriteria();

    /**
     * @return mixed
     */
    public function resetCriteria();
}