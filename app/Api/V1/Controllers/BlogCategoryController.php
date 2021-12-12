<?php

namespace App\Api\V1\Controllers;

use App\Http\Requests\BlogCategory\ListBlogCategoryRequest;
use App\Http\Requests\BlogCategory\CreateBlogCategoryRequest;
use App\Http\Requests\BlogCategory\UpdateBlogCategoryRequest;
use App\Http\Requests\GenericPageRequest;
use App\Services\Contract\IBlogCategoryService;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
    private $_blogCategoryService;

    private $_request;

    private $_createBlogCategoryRequest;

    private $_updateBlogCategoryRequest;

    /**
     * RoleController constructor.
     * @param Request $request
     * @param IBlogCategoryService $blogCategoryService
     */
    public function __construct(Request $request, IBlogCategoryService $blogCategoryService)
    {
        $this->_request = $request;

        $this->_blogCategoryService = $blogCategoryService;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $customRequest = new ListBlogCategoryRequest();

        $customRequest->parent_id = $this->_request->get('parent_id');

        $pageRequest = new GenericPageRequest();

        $pageRequest->draw = $this->_request->get('draw');
        $pageRequest->start = $this->_request->get('start');
        $pageRequest->length = $this->_request->get('length');

        $order[0]['column'] = $this->_request->get('order')[0]['column'];
        $order[0]['dir'] = $this->_request->get('order')[0]['dir'];
        $pageRequest->order = $order[0];

        $columns[0]['name'] = $this->_request->get('columns')[0]['name'];
        $columns[1]['name'] = $this->_request->get('columns')[1]['name'];
        $columns[2]['name'] = $this->_request->get('columns')[2]['name'];
        $pageRequest->columns = $columns;

        $pageRequest->search = $this->_request->get('search')['value'];

        $pageRequest->custom = $customRequest;

        $result = $this->_blogCategoryService->getAll($pageRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetail($id)
    {
        $result = $this->_blogCategoryService->getDetail($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $this->_createBlogCategoryRequest = new CreateBlogCategoryRequest();

        $this->_createBlogCategoryRequest->parent_id = $this->_request->input('parent_id');
        $this->_createBlogCategoryRequest->name = $this->_request->input('name');
        $this->_createBlogCategoryRequest->slug = $this->_request->input('slug');
        $this->_createBlogCategoryRequest->description = $this->_request->input('description');

        $result = $this->_blogCategoryService->save($this->_createBlogCategoryRequest);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $this->_updateBlogCategoryRequest = new UpdateBlogCategoryRequest();

        $this->_updateBlogCategoryRequest->id = $this->_request->input('id');
        $this->_updateBlogCategoryRequest->parent_id = $this->_request->input('parent_id');
        $this->_updateBlogCategoryRequest->name = $this->_request->input('name');
        $this->_updateBlogCategoryRequest->slug = $this->_request->input('slug');
        $this->_updateBlogCategoryRequest->description = $this->_request->input('description');

        $result = $this->_blogCategoryService->update($this->_updateBlogCategoryRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $result = $this->_blogCategoryService->delete($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBlogCategoryByName()
    {
        $id = $this->_request->get('id');
        $name = $this->_request->get('name');

        $result = $this->_blogCategoryService->getBlogCategoryByName($id, $name);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBlogCategoryList()
    {
        $result = $this->_blogCategoryService->getBlogCategoryList();

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBlogCategoryHierarchy()
    {
        $result = $this->_blogCategoryService->getBlogCategoryHierarchy();

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBlogCategorySlugByName()
    {
        $name = $this->_request->get('name');

        $result = $this->_blogCategoryService->getBlogCategorySlugByName($name);

        return response()->json($result);
    }
}