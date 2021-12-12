<?php
namespace App\Api\V1\Controllers;

use App\Http\Requests\BlogTag\CreateBlogTagRequest;
use App\Http\Requests\BlogTag\UpdateBlogTagRequest;
use App\Http\Requests\GenericPageRequest;
use App\Services\Contract\IBlogTagService;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class BlogTagController extends Controller
{
    private $_blogTagService;

    private $_request;

    private $_createBlogTagRequest;

    private $_updateBlogTagRequest;

    /**
     * RoleController constructor.
     * @param Request $request
     * @param IBlogTagService $blogTagService
     */
    public function __construct(Request $request, IBlogTagService $blogTagService)
    {
        $this->_request = $request;

        $this->_blogTagService = $blogTagService;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $pageRequest = new GenericPageRequest();

        $pageRequest->draw = $this->_request->get('draw');
        $pageRequest->start = $this->_request->get('start');
        $pageRequest->length = $this->_request->get('length');

        $order[0]['column'] = $this->_request->get('order')[0]['column'];
        $order[0]['dir'] = $this->_request->get('order')[0]['dir'];
        $pageRequest->order = $order[0];

        $columns[0]['name'] = $this->_request->get('columns')[0]['name'];
        $columns[1]['name'] = $this->_request->get('columns')[1]['name'];
        $pageRequest->columns = $columns;

        $pageRequest->search = $this->_request->get('search')['value'];

        $result = $this->_blogTagService->getAll($pageRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetail($id)
    {
        $result = $this->_blogTagService->getDetail($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $this->_createBlogTagRequest = new CreateBlogTagRequest();

        $this->_createBlogTagRequest->name = $this->_request->input('name');
        $this->_createBlogTagRequest->slug = $this->_request->input('slug');

        $result = $this->_blogTagService->save($this->_createBlogTagRequest);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $this->_updateBlogTagRequest = new UpdateBlogTagRequest();

        $this->_updateBlogTagRequest->id = $this->_request->input('id');
        $this->_updateBlogTagRequest->name = $this->_request->input('name');
        $this->_updateBlogTagRequest->slug = $this->_request->input('slug');

        $result = $this->_blogTagService->update($this->_updateBlogTagRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $result = $this->_blogTagService->delete($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBlogTagByName()
    {
        $name = $this->_request->get('name');

        $result = $this->_blogTagService->getBlogTagByName($name);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBlogTagSlugByName()
    {
        $name = $this->_request->get('name');

        $result = $this->_blogTagService->getBlogTagSlugByName($name);

        return response()->json($result);
    }
}
