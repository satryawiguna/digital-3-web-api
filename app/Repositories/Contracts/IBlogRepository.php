<?php
namespace App\Repositories\Contract;


use App\Http\Requests\Blog\CreateBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;

interface IBlogRepository
{
    /**
     * @return mixed
     */
    public function model();

    /**
     * @param CreateBlogRequest $request
     * @return mixed
     */
    public function create(CreateBlogRequest $request);

    /**
     * @param UpdateBlogRequest $request
     * @return mixed
     */
    public function update(UpdateBlogRequest $request);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}