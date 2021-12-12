<?php
namespace App\Repositories\Criterias\Implement\ProductTag;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;
use Illuminate\Support\Facades\DB;

class GetAllProductTagCriteria extends BaseCriteria
{
    private $_keyword;

    /**
     * GetAllProductTagCriteria constructor.
     * @param $keyword
     */
    public function __construct($keyword)
    {
        $this->_keyword = $keyword;
    }

    public function apply($model, Repository $repository)
    {
        if (!empty($this->_keyword)) {
            $model = $model->whereRaw(DB::raw("(name LIKE '%" . $this->_keyword . "%' or slug LIKE '%" . $this->_keyword . "%')"));
        }

        return $model;
    }
}