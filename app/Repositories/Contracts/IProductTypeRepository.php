<?php
namespace App\Repositories\Contract;


use App\Http\Requests\ProductType\CreateProductTypeRequest;
use App\Http\Requests\ProductType\UpdateProductTypeRequest;

interface IProductTypeRepository
{
    /**
     * @return mixed
     */
    public function model();

    /**
     * @param CreateProductTypeRequest $request
     * @return mixed
     */
    public function create(CreateProductTypeRequest $request);

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
}