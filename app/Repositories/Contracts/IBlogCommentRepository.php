<?php
namespace App\Repositories\Contract;


use App\Http\Requests\BlogComment\CreateBlogCommentRequest;
use App\Http\Requests\BlogComment\UpdateBlogCommentRequest;

interface IBlogCommentRepository
{
    /**
     * @return mixed
     */
    public function model();

    /**
     * @param CreateBlogCommentRequest $request
     * @return mixed
     */
    public function create(CreateBlogCommentRequest $request);

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