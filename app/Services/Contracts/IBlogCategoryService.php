<?php
namespace App\Services\Contract;


use App\Http\Requests\BlogCategory\CreateBlogCategoryRequest;
use App\Http\Requests\BlogCategory\UpdateBlogCategoryRequest;
use App\Http\Requests\GenericPageRequest;

interface IBlogCategoryService
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
     * @param CreateBlogCategoryRequest $request
     * @return mixed
     */
    public function save(CreateBlogCategoryRequest $request);

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

    /**
     * @return mixed
     */
    public function getBlogCategoryList();

    /**
     * @return mixed
     */
    public function getBlogCategoryHierarchy();

    /**
     * @param $name
     * @return mixed
     */
    public function getBlogCategorySlugByName($name);
}