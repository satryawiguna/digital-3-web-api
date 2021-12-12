<?php
namespace App\Services\Contract;


use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\ProductComment\CreateProductCommentRequest;
use App\Http\Requests\ProductComment\UpdateProductCommentRequest;

interface IProductCommentService
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
     * @param CreateProductCommentRequest $request
     * @return mixed
     */
    public function save(CreateProductCommentRequest $request);

    /**
     * @param UpdateProductCommentRequest $request
     * @return mixed
     */
    public function update(UpdateProductCommentRequest $request);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    public function getAllProducts(GenericPageRequest $pageRequest);
}
