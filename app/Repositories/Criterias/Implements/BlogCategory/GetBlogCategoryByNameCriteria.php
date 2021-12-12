<?php
namespace App\Repositories\Criterias\Implement\BlogCategory;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;

class GetBlogCategoryByNameCriteria extends BaseCriteria
{
    private $_id;

    private $_name;

    /**
     * GetBlogCategoryByNameCriteria constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name)
    {
        $this->_id = $id;

        $this->_name = $name;
    }

    public function apply($model, Repository $repository)
    {
        if (!empty($this->_id)) {
            $model = $model->where('id', '<>', $this->_id);
        }

        $model = $model->where('name', 'LIKE', '%' . $this->_name . '%');

        return $model;
    }
}