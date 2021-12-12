<?php
namespace App\Repositories\Criterias\Implement\ProductTag;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetProductTagByAgentIdCriteria extends BaseCriteria
{
    private $_agent_id;

    /**
     * GetProductByAgentIdCriteria constructor.
     * @param $agentId
     */
    public function __construct($agentId)
    {
        $this->_agent_id = $agentId;
    }

    public function apply($model, Repository $repository)
    {
        if ($this->_agent_id) {
            $model = $model->where('agent_id', $this->_agent_id);
        }

        return $model;
    }
}