<?php

namespace App\Api\V1\Controllers;

use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\ProductType\CreateProductTypeRequest;
use App\Http\Requests\ProductType\UpdateProductTypeRequest;
use App\Services\Contract\IProductTypeService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductTypeController extends Controller
{
    private $_productTypeService;

    private $_request;

    private $_createProductTypeRequest;

    private $_updateProductTypeRequest;

    /**
     * ProductTypeController constructor.
     * @param Request $request
     * @param IProductTypeService $productTypeService
     */
    public function __construct(Request $request, IProductTypeService $productTypeService)
    {
        $this->_request = $request;

        $this->_productTypeService = $productTypeService;
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

        $result = $this->_productTypeService->getAll($pageRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetail($id)
    {
        $result = $this->_productTypeService->getDetail($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $this->_createProductTypeRequest = new CreateProductTypeRequest();

        $this->_createProductTypeRequest->name = $this->_request->input('name');
        $this->_createProductTypeRequest->description = $this->_request->input('description');

        $result = $this->_productTypeService->save($this->_createProductTypeRequest);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $this->_updateProductTypeRequest = new UpdateProductTypeRequest();

        $this->_updateProductTypeRequest->id = $this->_request->input('id');
        $this->_updateProductTypeRequest->name = $this->_request->input('name');
        $this->_updateProductTypeRequest->description = $this->_request->input('description');

        $result = $this->_productTypeService->update($this->_updateProductTypeRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $result = $this->_productTypeService->delete($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductTypeList()
    {
        $result = $this->_productTypeService->getProductTypeList();

        return response()->json($result);
    }

    public function getAllProductTypes()
    {
        $result = $this->_productTypeService->getAllProductTypes();

        return response()->json($result);
    }
}
