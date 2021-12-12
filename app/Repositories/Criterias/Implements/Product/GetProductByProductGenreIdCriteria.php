<?php
namespace App\Repositories\Criterias\Implement\Product;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetProductByProductGenreIdCriteria extends BaseCriteria
{
    private $_product_genre_id;

    /**
     * GetProductByProductGenreIdCriteria constructor.
     * @param $productGenreId
     */
    public function __construct($productGenreId)
    {
        $this->_product_genre_id = $productGenreId;
    }

    public function apply($model, Repository $repository)
    {
        if (!empty($this->_product_genre_id)) {
            $model = $model->where('product_genre_id', $this->_product_genre_id);
        }

        return $model;
    }
}