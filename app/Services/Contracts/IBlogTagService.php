<?php
namespace App\Services\Contract;


use App\Http\Requests\BlogTag\CreateBlogTagRequest;
use App\Http\Requests\BlogTag\UpdateBlogTagRequest;
use App\Http\Requests\GenericPageRequest;

interface IBlogTagService
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
     * @param CreateBlogTagRequest $request
     * @return mixed
     */
    public function save(CreateBlogTagRequest $request);

    /**
     * @param UpdateBlogTagRequest $request
     * @return mixed
     */
    public function update(UpdateBlogTagRequest $request);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $name
     * @return mixed
     */
    public function getBlogTagByName($name);

    /**
     * @param $name
     * @return mixed
     */
    public function getBlogTagSlugByName($name);
}