<?php

namespace App\Api\V1\Controllers;

use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\ListProductRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Requests\ProductImage\CreateProductImageRequest;
use App\Http\Requests\ProductTag\CreateProductTagRequest;
use App\Http\Requests\ProductVideo\CreateProductVideoRequest;
use App\Http\Requests\WayPoint\CreateWayPointRequest;
use App\Services\Contract\IProductService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    private $_productService;

    private $_request;

    private $_createProductRequest;

    private $_updateProductRequest;

    /**
     * ProductController constructor.
     * @param Request $request
     * @param IProductService $productService
     */
    public function __construct(Request $request, IProductService $productService)
    {
        $this->_request = $request;

        $this->_productService = $productService;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $customRequest = new ListProductRequest();

        $customRequest->product_type_id = $this->_request->get('product_type_id');
        $customRequest->product_genre_id = $this->_request->get('product_genre_id');

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
        $columns[3]['name'] = $this->_request->get('columns')[3]['name'];
        $columns[4]['name'] = $this->_request->get('columns')[4]['name'];
        $pageRequest->columns = $columns;

        $pageRequest->search = $this->_request->get('search')['value'];

        $pageRequest->custom = $customRequest;

        $result = $this->_productService->getAll($pageRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetail($id)
    {
        $result = $this->_productService->getDetail($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $this->_createProductRequest = new CreateProductRequest();

        $this->_createProductRequest->user_id = $this->_request->input('user_id');
        $this->_createProductRequest->product_type_id = $this->_request->input('product_type_id');
        $this->_createProductRequest->publish = $this->_request->input('publish');
        $this->_createProductRequest->title = $this->_request->input('title');
        $this->_createProductRequest->slug = $this->_request->input('slug');
        $this->_createProductRequest->description = $this->_request->input('description');
        $this->_createProductRequest->featured_image_url = $this->_request->input('featured_image_url');
        $this->_createProductRequest->year = $this->_request->input('year');
        $this->_createProductRequest->rating = $this->_request->input('rating');
        $this->_createProductRequest->director = $this->_request->input('director');
        $this->_createProductRequest->duration = $this->_request->input('duration');
        $this->_createProductRequest->media_type = $this->_request->input('media_type');
        $this->_createProductRequest->actors = $this->_request->input('actors');
        $this->_createProductRequest->status = $this->_request->input('status');
        $this->_createProductRequest->product_tag = $this->_request->input('product_tag');
        $this->_createProductRequest->product_genre = $this->_request->input('product_genre');

        $result = $this->_productService->save($this->_createProductRequest);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $this->_updateProductRequest = new UpdateProductRequest();

        $this->_updateProductRequest->id = $this->_request->input('id');
        $this->_updateProductRequest->user_id = $this->_request->input('user_id');
        $this->_updateProductRequest->product_type_id = $this->_request->input('product_type_id');
        $this->_updateProductRequest->title = $this->_request->input('title');
        $this->_updateProductRequest->slug = $this->_request->input('slug');
        $this->_updateProductRequest->description = $this->_request->input('description');
        $this->_updateProductRequest->featured_image_url = $this->_request->input('featured_image_url');
        $this->_updateProductRequest->year = $this->_request->input('year');
        $this->_updateProductRequest->rating = $this->_request->input('rating');
        $this->_updateProductRequest->director = $this->_request->input('director');
        $this->_updateProductRequest->duration = $this->_request->input('duration');
        $this->_updateProductRequest->media_type = $this->_request->input('media_type');
        $this->_updateProductRequest->actors = $this->_request->input('actors');
        $this->_updateProductRequest->status = $this->_request->input('status');
        $this->_updateProductRequest->product_tag = $this->_request->input('product_tag');
        $this->_updateProductRequest->product_genre = $this->_request->input('product_genre');

        $result = $this->_productService->update($this->_updateProductRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $result = $this->_productService->delete($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductByTitle()
    {
        $title = $this->_request->get('title');

        $result = $this->_productService->getProductByTitle($title);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getProductSlugByTitle()
    {
        $title = $this->_request->get('title');

        $result = $this->_productService->getProductSlugByTitle($title);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllProducts()
    {
        $custom = json_decode($this->_request->get('custom'));

        $customRequest = new ListProductRequest();
        $customRequest->product_type_id = $custom->type;
        $customRequest->product_genre_id = $custom->genre;

        $pageRequest = new GenericPageRequest();

        $pageRequest->length = 60;

        $order[0]['column'] = $custom->order->column;
        $order[0]['dir'] = $custom->order->dir;
        $pageRequest->order = $order[0];

        $columns[0]['name'] = 'products.id';
        $columns[1]['name'] = 'products.title';
        $columns[2]['name'] = 'products.year';
        $columns[3]['name'] = 'products.rating';
        $pageRequest->columns = $columns;

        $pageRequest->search = $this->_request->get('search');

        $pageRequest->custom = $customRequest;

        $result = $this->_productService->getAllProducts($pageRequest);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetailProducts()
    {
        $id = $this->_request->get('id');

        $result = $this->_productService->getDetailProducts($id);

        return response()->json($result);
    }
}
