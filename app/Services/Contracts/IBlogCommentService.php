<?php
namespace App\Services\Contract;


use App\Http\Requests\BlogComment\CreateBlogCommentRequest;
use App\Http\Requests\BlogComment\UpdateBlogCommentRequest;
use App\Http\Requests\GenericPageRequest;

interface IBlogCommentService
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
     * @param CreateBlogCommentRequest $request
     * @return mixed
     */
    public function save(CreateBlogCommentRequest $request);

    /**
     * @param UpdateBlogCommentRequest $request
     * @return mixed
     */
    public function update(UpdateBlogCommentRequest $request);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}