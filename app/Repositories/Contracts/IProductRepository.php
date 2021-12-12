<?php
namespace App\Repositories\Contract;


use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

interface IProductRepository
{
    /**
     * @return mixed
     */
    public function model();

    /**
     * @param CreateProductRequest $request
     * @return mixed
     */
    public function create(CreateProductRequest $request);

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
}