<?php
namespace App\Services\Contract;


use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

interface IProductService
{
    /**
     * @param GenericPageRequest $pageRequest
     * @return mixed
     */
    public function getAll(GenericPageRequest $pageRequest);

    /**
     * @param $id
     * @return mixed
     */
    public function getDetail($id);

    /**
     * @param CreateProductRequest $request
     * @return mixed
     */
    public function save(CreateProductRequest $request);

    /**
     * @param UpdateProductRequest $request
     * @return mixed
     */
    public function update(UpdateProductRequest $request);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $title
     * @return mixed
     */
    public function getProductByTitle($title);

    /**
     * @param $title
     * @return mixed
     */
    public function getProductSlugByTitle($title);

    /**
     * @param GenericPageRequest $pageRequest
     * @return mixed
     */
    public function getAllProducts(GenericPageRequest $pageRequest);

    /**
     * @param $id
     * @return mixed
     */
    public function getDetailProducts($id);
}