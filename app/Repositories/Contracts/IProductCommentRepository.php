<?php
namespace App\Repositories\Contract;


use App\Http\Requests\ProductComment\CreateProductCommentRequest;
use App\Http\Requests\ProductComment\UpdateProductCommentRequest;

interface IProductCommentRepository
{
    /**
     * @return mixed
     */
    public function model();

    /**
     * @param CreateProductCommentRequest $request
     * @return mixed
     */
    public function create(CreateProductCommentRequest $request);

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
}