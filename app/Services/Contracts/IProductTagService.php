<?php
namespace App\Services\Contract;


use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\ProductTag\CreateProductTagRequest;
use App\Http\Requests\ProductTag\UpdateProductTagRequest;

interface IProductTagService
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
     * @param CreateProductTagRequest $request
     * @return mixed
     */
    public function save(CreateProductTagRequest $request);

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

    /**
     * @param $name
     * @return mixed
     */
    public function getProductTagByName($name);

    /**
     * @param $name
     * @return mixed
     */
    public function getProductTagSlugByName($name);
}