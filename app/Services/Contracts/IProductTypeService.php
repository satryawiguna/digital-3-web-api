<?php
namespace App\Services\Contract;


use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\ProductType\CreateProductTypeRequest;
use App\Http\Requests\ProductType\UpdateProductTypeRequest;

interface IProductTypeService
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
     * @param CreateProductTypeRequest $request
     * @return mixed
     */
    public function save(CreateProductTypeRequest $request);

    /**
     * @param UpdateProductTypeRequest $request
     * @return mixed
     */
    public function update(UpdateProductTypeRequest $request);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @return mixed
     */
    public function getProductTypeList();

    /**
     * @return mixed
     */
    public function getAllProductTypes();
}