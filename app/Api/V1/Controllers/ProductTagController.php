<?php

namespace App\Api\V1\Controllers;

use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\ProductTag\CreateProductTagRequest;
use App\Http\Requests\ProductTag\ListProductTagRequest;
use App\Http\Requests\ProductTag\UpdateProductTagRequest;
use App\Services\Contract\IProductTagService;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductTagController extends Controller
{
    private $_productTagService;

    private $_request;

    private $_createProductTagRequest;

    private $_updateProductTagRequest;

    /**
     * RoleController constructor.
     * @param Request $request
     * @param IProductTagService $productTagService
     */
    public function __construct(Request $request, IProductTagService $productTagService)
    {
        $this->_request = $request;

        $this->_productTagService = $productTagService;
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

        $result = $this->_productTagService->getAll($pageRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetail($id)
    {
        $result = $this->_productTagService->getDetail($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $this->_createProductTagRequest = new CreateProductTagRequest();

        $this->_createProductTagRequest->name = $this->_request->input('name');
        $this->_createProductTagRequest->slug = $this->_request->input('slug');

        $result = $this->_productTagService->save($this->_createProductTagRequest);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $this->_updateProductTagRequest = new UpdateProductTagRequest();

        $this->_updateProductTagRequest->id = $this->_request->input('id');
        $this->_updateProductTagRequest->name = $this->_request->input('name');
        $this->_updateProductTagRequest->slug = $this->_request->input('slug');

        $result = $this->_productTagService->update($this->_updateProductTagRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $result = $this->_productTagService->delete($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductTagByName()
    {
        $name = $this->_request->get('name');

        $result = $this->_productTagService->getProductTagByName($name);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductTagSlugByName()
    {
        $name = $this->_request->get('name');

        $result = $this->_productTagService->getProductTagSlugByName($name);

        return response()->json($result);
    }
}
