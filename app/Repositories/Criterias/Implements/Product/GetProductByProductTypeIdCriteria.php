<?php
namespace App\Repositories\Criterias\Implement\Product;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetProductByProductTypeIdCriteria extends BaseCriteria
{
    private $_product_type_id;

    /**
     * GetProductByProductTypeIdCriteria constructor.
     * @param $productTypeId
     */
    public function __construct($productTypeId)
    {
        $this->_product_type_id = $productTypeId;
    }

    public function apply($model, Repository $repository)
    {
        if (!empty($this->_product_type_id)) {
            $model = $model->where('product_type_id', $this->_product_type_id);
        }

        return $model;
    }
}