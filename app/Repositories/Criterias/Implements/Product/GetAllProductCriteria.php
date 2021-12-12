<?php
namespace App\Repositories\Criterias\Implement\Product;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetAllProductCriteria extends BaseCriteria
{
    private $_keyword;

    /**
     * GetAllProductCriteria constructor.
     * @param $keyword
     */
    public function __construct($keyword)
    {
        $this->_keyword = $keyword;
    }

    public function apply($model, Repository $repository)
    {
        $model = $model->select(['products.*'])
            ->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->join('product_product_genres', 'products.id', '=', 'product_product_genres.product_id')
            ->join('product_genres', 'product_genres.id', '=', 'product_product_genres.product_genre_id');

        if (!empty($this->_keyword)) {
            $model = $model->where('products.title', 'LIKE', '%' . $this->_keyword . '%');
        }

        return $model;
    }
}