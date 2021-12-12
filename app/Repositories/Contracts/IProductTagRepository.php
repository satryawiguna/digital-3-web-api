<?php
namespace App\Repositories\Contract;


use App\Http\Requests\ProductTag\CreateProductTagRequest;
use App\Http\Requests\ProductTag\UpdateProductTagRequest;

interface IProductTagRepository
{
    /**
     * @return mixed
     */
    public function model();

    /**
     * @param CreateProductTagRequest $request
     * @return mixed
     */
    public function create(CreateProductTagRequest $request);

    /**
     * @param UpdateProductTagRequest $request
     * @return mixed
     */
    public function update(UpdateProductTagRequest $request);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}