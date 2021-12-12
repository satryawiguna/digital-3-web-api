<?php
namespace App\Http\Requests\Product;


class ListProductRequest
{
    // Default Property

    public $product_type_id;

    public $product_genre_id;

    public $product_tag_id;

    /**
     * @return mixed
     */
    public function getProductTypeId()
    {
        return $this->product_type_id;
    }

    /**
     * @param mixed $product_type_id
     */
    public function setProductTypeId($product_type_id)
    {
        $this->product_type_id = $product_type_id;
    }

    /**
     * @return mixed
     */
    public function getProductGenreId()
    {
        return $this->product_genre_id;
    }

    /**
     * @param mixed $product_genre_id
     */
    public function setProductGenreId($product_genre_id)
    {
        $this->product_genre_id = $product_genre_id;
    }

    /**
     * @return mixed
     */
    public function getProductTagId()
    {
        return $this->product_tag_id;
    }

    /**
     * @param mixed $product_tag_id
     */
    public function setProductTagId($product_tag_id)
    {
        $this->product_tag_id = $product_tag_id;
    }

}