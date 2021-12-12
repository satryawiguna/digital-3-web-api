<?php
namespace App\Services\Contract;


use App\Http\Requests\Blog\CreateBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Http\Requests\GenericPageRequest;

interface IBlogService
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
     * @param CreateBlogRequest $request
     * @return mixed
     */
    public function save(CreateBlogRequest $request);

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

    /**
     * @param $title
     * @return mixed
     */
    public function getBlogSlugByTitle($title);
}