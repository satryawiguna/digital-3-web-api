<?php
namespace App\Http\Requests\ProductGenre;


use App\Http\Requests\Request;

class ListProductGenreRequest extends Request
{
    // Default Property

    public $parent_id;

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parent_id;
    }

    /**
     * @param mixed $parent_id
     */
    public function setParentId($parent_id)
    {
        $this->parent_id = $parent_id;
    }
}