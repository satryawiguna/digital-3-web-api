<?php
namespace App\Repositories\Contract;


interface IRepository
{
    /**
     * @param array $columns
     * @return mixed
     */
    public function fetchAll($columns = array('*'));

    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function fetchFind($id, $columns = array('*'));

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function fetchFindBy($field, $value, $columns = array('*'));

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function fetchFindAllBy($field, $value, $columns = array('*'));

    /**
     * @param $where
     * @param array $columns
     * @param bool $or
     * @return mixed
     */
    public function fetchFindSearch($where, $columns = array('*'), $or = false);

    /**
     * @param $field
     * @param array $values
     * @param array $columns
     * @return mixed
     */
    public function fetchFindSearchIn($field, array $values, $columns = array('*'));

    /**
     * @param $field
     * @param array $values
     * @param array $columns
     * @return mixed
     */
    public function fetchFindSearchNotIn($field, array $values, $columns = array('*'));

    /**
     * @param null $limit
     * @param array $columns
     * @return mixed
     */
    public function simplePagination($limit = null, $columns = array('*'));

    /**
     * @param null $limit
     * @param null $offset
     * @param array $columns
     * @return mixed
     */
    public function offsetPagination($limit = null, $offset = null, $columns = array('*'));

    /**
     * @param $columns
     * @return mixed
     */
    public function select($columns = array('*'));

    /**
     * @param $relations
     * @return mixed
     */
    public function with($relations);

    /**
     * @param $field
     * @param $value
     * @param string $operator
     * @return mixed
     * @internal param array $filter
     */
    public function singleWhere($field, $value, $operator = '=');

    /**
     * @param $field
     * @param $value
     * @param string $operator
     * @return mixed
     */
    public function singleOrWhere($field, $value, $operator = '=');

    /**
     * @param array $filter
     * @return mixed
     */
    public function multiWhere(array $filter);

    /**
     * @param array $filter
     * @return mixed
     */
    public function multiOrWhere(array $filter);

    /**
     * @param $filter
     * @return mixed
     */
    public function rawWhere($filter);

    /**
     * @param $field
     * @param $value
     * @param string $operator
     * @return mixed
     */
    public function singleHaving($field, $value, $operator = '=');

    /**
     * @param $filter
     * @return mixed
     */
    public function rawHaving($filter);

    /**
     * @param $relation
     * @param $foreign
     * @param string $operator
     * @param $primary
     * @return mixed
     */
    public function join($relation, $foreign, $operator = '=', $primary);

    /**
     * @param $relation
     * @param $foreign
     * @param string $operator
     * @param $primary
     * @return mixed
     */
    public function leftJoin($relation, $foreign, $operator = '=', $primary);

    /**
     * @param $column
     * @param string $direction
     * @return mixed
     */
    public function orderBy($column, $direction = 'asc');

    /**
     * @param $column
     * @return mixed
     */
    public function groupBy($column);

}
