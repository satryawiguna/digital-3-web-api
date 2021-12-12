<?php
namespace App\Repositories\Criterias\Implement\BlogCategory;


use App\Repositories\Contract\IRepository as Repository;
use App\Repositories\Criterias\Implement\BaseCriteria;
use Illuminate\Support\Facades\DB;

class GetAllBlogCategoryCriteria extends BaseCriteria
{
    private $_keyword;

    /**
     * GetAllBlogCategoryCriteria constructor.
     * @param $keyword
     */
    public function __construct($keyword)
    {
        $this->_keyword = $keyword;
    }

    public function apply($model, Repository $repository)
    {
        $model = $model->select('*', 'id as parent',
            DB::raw('(SELECT COUNT(*) FROM blog_categories WHERE parent_id = parent) as child'));

        if (!empty($this->_keyword)) {
            $model = $model->whereRaw(DB::raw("(name LIKE '%" . $this->_keyword . "%' or description LIKE '%" . $this->_keyword . "%')"));
        }

        return $model;
    }
}