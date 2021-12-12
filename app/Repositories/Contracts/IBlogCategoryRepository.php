<?php
namespace App\Repositories\Contract;


use App\Http\Requests\BlogCategory\CreateBlogCategoryRequest;
use App\Http\Requests\BlogCategory\UpdateBlogCategoryRequest;

interface IBlogCategoryRepository
{
    /**
     * @return mixed
     */
    public function model();

    /**
     * @param CreateBlogCategoryRequest $request
     * @return mixed
     */
    public function create(CreateBlogCategoryRequest $request);

    /**
     * @param UpdateBlogCategoryRequest $request
     * @return mixed
     */
    public function update(UpdateBlogCategoryRequest $request);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}