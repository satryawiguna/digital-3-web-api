<?php

namespace App\Api\V1\Controllers;

use App\Http\Requests\Blog\ListBlogRequest;
use App\Http\Requests\Blog\CreateBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Http\Requests\GenericPageRequest;
use App\Services\Contract\IBlogService;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    private $_blogService;

    private $_request;

    private $_createBlogRequest;

    private $_updateBlogRequest;

    /**
     * BlogController constructor.
     * @param Request $request
     * @param IBlogService $blogService
     */
    public function __construct(Request $request, IBlogService $blogService)
    {
        $this->_request = $request;

        $this->_blogService = $blogService;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $customRequest = new ListBlogRequest();

        $customRequest->blog_category_id = $this->_request->get('blog_category_id');
        $customRequest->blog_tag_id = $this->_request->get('blog_tag_id');

        $pageRequest = new GenericPageRequest();

        $pageRequest->draw = $this->_request->get('draw');
        $pageRequest->start = $this->_request->get('start');
        $pageRequest->length = $this->_request->get('length');

        $order[0]['column'] = $this->_request->get('order')[0]['column'];
        $order[0]['dir'] = $this->_request->get('order')[0]['dir'];
        $pageRequest->order = $order[0];

        $columns[0]['name'] = $this->_request->get('columns')[0]['name'];
        $pageRequest->columns = $columns;

        $pageRequest->search = $this->_request->get('search')['value'];

        $pageRequest->custom = $customRequest;

        $result = $this->_blogService->getAll($pageRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetail($id)
    {
        $result = $this->_blogService->getDetail($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $this->_createBlogRequest = new CreateBlogRequest();

        $this->_createBlogRequest->user_id = $this->_request->input('user_id');
        $this->_createBlogRequest->publish = $this->_request->input('publish');
        $this->_createBlogRequest->title = $this->_request->input('title');
        $this->_createBlogRequest->slug = $this->_request->input('slug');
        $this->_createBlogRequest->contents = $this->_request->input('contents');
        $this->_createBlogRequest->featured_image_url = $this->_request->input('featured_image_url');
        $this->_createBlogRequest->status = $this->_request->input('status');

        $this->_createBlogRequest->blog_category = $this->_request->input('blog_category');
        $this->_createBlogRequest->blog_tag = $this->_request->input('blog_tag');

        $result = $this->_blogService->save($this->_createBlogRequest);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $this->_updateBlogRequest = new UpdateBlogRequest();

        $this->_updateBlogRequest->id = $this->_request->input('id');
        $this->_updateBlogRequest->user_id = $this->_request->input('user_id');
        $this->_updateBlogRequest->title = $this->_request->input('title');
        $this->_updateBlogRequest->slug = $this->_request->input('slug');
        $this->_updateBlogRequest->contents = $this->_request->input('contents');
        $this->_updateBlogRequest->featured_image_url = $this->_request->input('featured_image_url');
        $this->_updateBlogRequest->status = $this->_request->input('status');

        $this->_updateBlogRequest->blog_category = $this->_request->input('blog_category');
        $this->_updateBlogRequest->blog_tag = $this->_request->input('blog_tag');

        $result = $this->_blogService->update($this->_updateBlogRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $result = $this->_blogService->delete($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBlogSlugByTitle()
    {
        $title = $this->_request->get('title');

        $result = $this->_blogService->getBlogSlugByTitle($title);

        return response()->json($result);
    }
}
