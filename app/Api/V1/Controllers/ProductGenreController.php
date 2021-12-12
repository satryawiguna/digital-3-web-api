<?php

namespace App\Api\V1\Controllers;

use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\ProductGenre\CreateProductGenreRequest;
use App\Http\Requests\ProductGenre\ListProductGenreRequest;
use App\Http\Requests\ProductGenre\UpdateProductGenreRequest;
use App\Services\Contract\IProductGenreService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductGenreController extends Controller
{
    private $_productGenreService;

    private $_request;

    private $_createProductGenreRequest;

    private $_updateProductGenreRequest;

    /**
     * ProductGenreController constructor.
     * @param Request $request
     * @param IProductGenreService $productGenreService
     */
    public function __construct(Request $request, IProductGenreService $productGenreService)
    {
        $this->_request = $request;

        $this->_productGenreService = $productGenreService;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $customRequest = new ListProductGenreRequest();

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

        $result = $this->_productGenreService->getAll($pageRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetail($id)
    {
        $result = $this->_productGenreService->getDetail($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $this->_createProductGenreRequest = new CreateProductGenreRequest();

        $this->_createProductGenreRequest->parent_id = $this->_request->input('parent_id');
        $this->_createProductGenreRequest->name = $this->_request->input('name');
        $this->_createProductGenreRequest->slug = $this->_request->input('slug');
        $this->_createProductGenreRequest->description = $this->_request->input('description');

        $result = $this->_productGenreService->save($this->_createProductGenreRequest);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $this->_updateProductGenreRequest = new UpdateProductGenreRequest();

        $this->_updateProductGenreRequest->id = $this->_request->input('id');
        $this->_updateProductGenreRequest->parent_id = $this->_request->input('parent_id');
        $this->_updateProductGenreRequest->name = $this->_request->input('name');
        $this->_updateProductGenreRequest->slug = $this->_request->input('slug');
        $this->_updateProductGenreRequest->description = $this->_request->input('description');

        $result = $this->_productGenreService->update($this->_updateProductGenreRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $result = $this->_productGenreService->delete($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductGenreByName()
    {
        $id = $this->_request->get('id');
        $name = $this->_request->get('name');

        $result = $this->_productGenreService->getProductGenreByName($id, $name);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductGenreList()
    {
        $result = $this->_productGenreService->getProductGenreList();

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductGenreHierarchy()
    {
        $result = $this->_productGenreService->getProductGenreHierarchy();

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductGenreSlugByName()
    {
        $name = $this->_request->get('name');

        $result = $this->_productGenreService->getProductGenreSlugByName($name);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProductGenres($id)
    {
        $result = $this->_productGenreService->getAllProductGenres($id);

        return response()->json($result);
    }
}
