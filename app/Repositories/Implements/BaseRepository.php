<?php
namespace App\Repositories\Implement;


use App\Repositories\Contract\IRepository;
use App\Repositories\Criterias\Contracts\ICriteria;
use App\Repositories\Criterias\Implement\BaseCriteria as Criteria;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Container\Container as App;
use Illuminate\Support\Collection;

abstract class BaseRepository implements IRepository, ICriteria
{
    private $_app;

    protected $_model;

    protected $_criteria;

    protected $_skipCriteria = false;

    protected $_preventCriteriaOverwriting = true;

    /**
     * BaseRepository constructor.
     * @throws Exception
     */
    public function __construct()
    {
        $this->_app = new App();

        $this->makeModel();
    }

    /**
     * @return mixed
     */
    abstract public function model();

    /**
     * @return Model
     * @throws Exception
     */
    public function makeModel()
    {
        $model = $this->_app->make($this->model());

        if (!$model instanceof Model) {
            throw new Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->_model = $model;
    }

    /**
     * @throws Exception
     */
    public function resetModel()
    {
        $this->makeModel();
    }

    /**
     * @return mixed
     */
    public function getCriteria()
    {
        return $this->_criteria;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function getByCriteria(Criteria $criteria)
    {
        $this->_model = $criteria->apply($this->_model, $this);

        return $this;
    }

    /**
     * @param Criteria $criteria
     * @return $this
     */
    public function pushCriteria(Criteria $criteria)
    {
        if ($this->_preventCriteriaOverwriting) {
            $key = $this->_criteria->search(function ($item) use ($criteria) {
                return (is_object($item) && (get_class($item) == get_class($criteria)));
            });

            if (is_int($key)) {
                $this->_criteria->offsetUnset($key);
            }
        }

        $this->_criteria->push($criteria);

        return $this;
    }

    /**
     * @return $this
     */
    public function applyCriteria()
    {
        if ($this->_skipCriteria === true)
            return $this;

        foreach ($this->getCriteria() as $criteria) {
            if ($criteria instanceof Criteria) {
                $this->_model = $criteria->apply($this->_model, $this);
            }
        }

        return $this;
    }

    /**
     *
     */
    public function resetCriteria()
    {
        $this->_criteria = new Collection();
    }

    /**
     * @param bool $status
     * @return $this
     */
    public function skipCriteria($status = true)
    {
        $this->_skipCriteria = $status;

        return $this;
    }

    /**
     * @param bool $reset
     * @param array $columns
     * @return mixed
     */
    public function fetchAll($reset = true, $columns = array('*'))
    {
        $this->applyCriteria();

        $result = $this->_model->get($columns);

        if ($reset)
            $this->resetModel();

        $this->resetCriteria();

        return $result;
    }

    /**
     * @param $id
     * @param bool $reset
     * @param array $columns
     * @return mixed
     */
    public function fetchFind($id, $reset = true, $columns = array('*'))
    {
        $this->applyCriteria();

        $result =  $this->_model->find($id, $columns);

        if ($reset)
            $this->resetModel();

        $this->resetCriteria();

        return $result;
    }

    /**
     * @param $field
     * @param $value
     * @param bool $reset
     * @param array $columns
     * @return mixed
     */
    public function fetchFindBy($field, $value, $reset = true, $columns = array('*'))
    {
        $this->applyCriteria();

        $result = $this->_model->where($field, '=', $value)->first($columns);

        if ($reset)
            $this->resetModel();

        $this->resetCriteria();

        return $result;
    }

    /**
     * @param $field
     * @param $value
     * @param bool $reset
     * @param array $columns
     * @return mixed
     */
    public function fetchFindAllBy($field, $value, $reset = true, $columns = array('*'))
    {
        $this->applyCriteria();

        $result = $this->_model->where($field, '=', $value)->get($columns);

        if ($reset)
            $this->resetModel();

        $this->resetCriteria();

        return $result;
    }

    /**
     * @param $where
     * @param bool $reset
     * @param array $columns
     * @param bool $or
     * @return mixed
     */
    public function fetchFindSearch($where, $reset = true, $columns = array('*'), $or = false)
    {
        $this->applyCriteria();

        $model = $this->_model;

        foreach ($where as $field => $value) {
            if ($value instanceof \Closure) {
                $model = (!$or) ? $model->where($value) : $model->orWhere($value);
            } elseif (is_array($value)) {
                if (count($value) === 3) {
                    list($field, $operator, $search) = $value;
                    $model = (!$or) ? $model->where($field, $operator, $search) : $model->orWhere($field, $operator, $search);
                } elseif (count($value) === 2) {
                    list($field, $search) = $value;
                    $model = (!$or) ? $model->where($field, '=', $search) : $model->orWhere($field, '=', $search);
                }
            } else {
                $model = (!$or) ? $model->where($field, '=', $value) : $model->orWhere($field, '=', $value);
            }
        }

        $result = $model->get($columns);

        if ($reset)
            $this->resetModel();

        $this->resetCriteria();

        return $result;
    }

    /**
     * @param $field
     * @param array $values
     * @param bool $reset
     * @param array $columns
     * @return mixed
     */
    public function fetchFindSearchIn($field, array $values, $reset = true, $columns = array('*'))
    {
        $this->applyCriteria();

        $result = $this->_model->whereIn($field, $values)->get($columns);

        if ($reset)
            $this->resetModel();

        $this->resetCriteria();

        return $result;
    }

    /**
     * @param $field
     * @param array $values
     * @param bool $reset
     * @param array $columns
     * @return mixed
     */
    public function fetchFindSearchNotIn($field, array $values, $reset = true, $columns = array('*'))
    {
        $this->applyCriteria();

        $result = $this->_model->whereNotIn($field, $values)->get($columns);

        if ($reset)
            $this->resetModel();

        $this->resetCriteria();

        return $result;
    }

    /**
     * @param null $limit
     * @param bool $reset
     * @param array $columns
     * @param string $page
     * @return mixed
     */
    public function simplePagination($limit = null, $reset = true, $columns = array('*'), $page = 'page')
    {
        $this->applyCriteria();

        $result = $this->_model->paginate($limit, $columns, $page);

        if ($reset)
            $this->resetModel();

        $this->resetCriteria();

        return $result;
    }

    /**
     * @param null $limit
     * @param null $offset
     * @param bool $reset
     * @param array $columns
     * @return mixed
     */
    public function offsetPagination($limit = null, $offset = null, $reset = true, $columns = array('*'))
    {
        $this->applyCriteria();

        $result = $this->_model->skip($offset)->take($limit)->get();

        if ($reset)
            $this->resetModel();

        $this->resetCriteria();

        return $result;
    }

    /**
     * @param $columns
     * @return $this
     */
    public function select($columns = array('*'))
    {
        $this->_model = $this->_model->select($columns);

        return $this;
    }

    /**
     * @param array|string $relations
     * @return $this
     */
    public function with($relations)
    {
        $this->_model = $this->_model->with($relations);

        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @param string $operator
     * @return $this
     */
    public function singleWhere($field, $value, $operator = '=')
    {
        $this->_model = $this->_model->where($field, $value, $operator);

        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @param string $operator
     * @return $this
     */
    public function singleOrWhere($field, $value, $operator = '=')
    {
        $this->_model = $this->_model->orWhere($field, $value, $operator);

        return $this;
    }

    /**
     * @param array $filter
     * @return $this
     */
    public function multiWhere(array $filter)
    {
        $this->_model = $this->_model->where($filter);

        return $this;
    }

    /**
     * @param array $filter
     * @return $this
     */
    public function multiOrWhere(array $filter)
    {
        $this->_model = $this->_model->orWhere($filter);

        return $this;
    }

    /**
     * @param $filter
     * @return $this
     */
    public function rawWhere($filter)
    {
        $this->_model = $this->_model->whereRaw($filter);

        return $this;
    }

    /**
     * @param $field
     * @param $value
     * @param string $operator
     * @return $this
     */
    public function singleHaving($field, $value, $operator = '=')
    {
        $this->_model = $this->_model->having($field, $value, $operator);

        return $this;
    }

    /**
     * @param $filter
     * @return $this
     */
    public function rawHaving($filter)
    {
        $this->_model = $this->_model->havingRaw($filter);

        return $this;
    }

    /**
     * @param $relation
     * @param $foreign
     * @param string $operator
     * @param $primary
     * @return $this
     */
    public function join($relation, $foreign, $operator = '=', $primary)
    {
        $this->_model = $this->_model->join($relation, $foreign, $operator, $primary);

        return $this;
    }

    /**
     * @param $relation
     * @param $foreign
     * @param string $operator
     * @param $primary
     * @return $this
     */
    public function leftJoin($relation, $foreign, $operator = '=', $primary)
    {
        $this->_model = $this->_model->leftJoin($relation, $foreign, $operator, $primary);

        return $this;
    }

    /**
     * @param $column
     * @param string $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'desc')
    {
        $this->_model = $this->_model->orderBy($column, $direction);

        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function groupBy($column)
    {
        $this->_model = $this->_model->groupBy($column);

        return $this;
    }
}
