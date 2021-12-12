<?php
namespace App\Services\Implement;


use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Http\Responses\BaseResponse;
use App\Http\Responses\GenericPageResponse;
use App\Http\Responses\GenericResponse;
use App\Repositories\Contract\IProductRepository;
use App\Repositories\Criterias\Implement\Product\GetAllProductCriteria;
use App\Repositories\Criterias\Implement\Product\GetProductByProductGenreIdCriteria;
use App\Repositories\Criterias\Implement\Product\GetProductByProductTypeIdCriteria;
use App\Repositories\Criterias\Implement\Product\GetProductByTitleCriteria;
use App\Services\Contract\IProductService;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Kumuwai\DataTransferObject\Laravel5DTO;

class ProductService extends BaseService implements IProductService
{
    private $_productRepository;

    /**
     * ProductService constructor.
     * @param IProductRepository $productRepository
     */
    public function __construct(IProductRepository $productRepository)
    {
        $this->_productRepository = $productRepository;
    }

    /**
     * @param GenericPageRequest $pageRequest
     * @return GenericResponse
     */
    public function getAll(GenericPageRequest $pageRequest)
    {
        $models = $this->_productRepository->pushCriteria(new GetAllProductCriteria($pageRequest->getSearch()))
            ->pushCriteria(new GetProductByProductTypeIdCriteria($pageRequest->getCustom()->product_type_id))
            ->pushCriteria(new GetProductByProductGenreIdCriteria($pageRequest->getCustom()->product_genre_id))
            ->with(['product_type', 'product_genre'])
            ->orderBy($pageRequest->columns[$pageRequest->order['column']]['name'], $pageRequest->order['dir']);

        $all = $models->fetchAll($reset = false)->count();
        $models = $models->offsetPagination($pageRequest->getLength(), $pageRequest->getStart());

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => (int)$model->id,
                'publish' => date('F, d Y', strtotime($model->publish)),
                'title' => $model->title,
                'status' => (int)$model->status,
                'product_type' => $model->product_type,
                'product_genre' => $model->product_genre
            ]);

        $this->_genericPageResponse = new GenericPageResponse();
        $this->_genericPageResponse->setDraw($pageRequest->draw);
        $this->_genericPageResponse->setRecordsTotal($all);
        $this->_genericPageResponse->setRecordsFiltered($all);
        $this->_genericPageResponse->setDto(Collection::make($output));

        return $this->_genericPageResponse;
    }

    /**
     * @param $id
     * @return GenericResponse
     */
    public function getDetail($id)
    {
        $model = $this->_productRepository->skipCriteria()
            ->with(['product_genre', 'product_tag'])->fetchFind($id);

        $output = new Laravel5DTO([
            'id' => (int)$model->id,
            'user_id' => (int)$model->user_id,
            'product_type_id' => (int)$model->product_type_id,
            'publish' => $model->publish,
            'title' => $model->title,
            'slug' => $model->slug,
            'description' => $model->description,
            'featured_image_url' => $model->featured_image_url,
            'year' => (int)$model->year,
            'rating' => $model->rating,
            'director' => $model->director,
            'duration' => $model->duration,
            'media_type' => $model->media_type,
            'actors' => $model->actors,
            'status' => (int)$model->status,
            'product_genre' => $model->product_genre,
            'product_tag' => $model->product_tag
        ]);


        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }

    /**
     * @param CreateProductRequest $request
     * @return \App\Http\Responses\BaseResponse
     */
    public function save(CreateProductRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $this->_baseResponse->_result = $this->_productRepository->create($request);
                $this->_baseResponse->addSuccessMessage("Product created");

            } catch (Exception $ex) {
                $this->_baseResponse->addErrorMessage($ex->getMessage());

            }
        }

        return $this->_baseResponse;
    }

    /**
     * @param UpdateProductRequest $request
     * @return \App\Http\Responses\BaseResponse
     */
    public function update(UpdateProductRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $this->_baseResponse->_result = $this->_productRepository->update($request);
                $this->_baseResponse->addSuccessMessage("Product updated");

            } catch (Exception $ex) {
                $this->_baseResponse->addErrorMessage($ex->getMessage());

            }
        }

        return $this->_baseResponse;
    }

    /**
     * @param $id
     * @return \App\Http\Responses\BaseResponse
     */
    public function delete($id)
    {
        $this->_baseResponse = new BaseResponse();

        try {
            $this->_baseResponse->_result = $this->_productRepository->delete($id);
            $this->_baseResponse->addSuccessMessage("Product deleted");

        } catch (Exception $ex) {
            $this->_baseResponse->addErrorMessage($ex->getMessage());
        }

        return $this->_baseResponse;
    }

    /**
     * @param $title
     * @return GenericPageResponse
     */
    public function getProductByTitle($title)
    {
        $models = $this->_productRepository->pushCriteria(new GetProductByTitleCriteria($title));
        $models = $models->fetchAll();

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => (int)$model->id,
                'title' => $model->title
            ]);

        $this->_genericPageResponse = new GenericPageResponse();
        $this->_genericPageResponse->setDto(Collection::make($output));

        return $this->_genericPageResponse;
    }

    /**
     * @param $title
     * @return mixed
     */
    public function getProductSlugByTitle($title)
    {
        $model = $this->_productRepository->model();

        $slug = SlugService::createSlug(new $model, 'slug', $title);

        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->dto = compact('slug');

        return $this->_genericResponse;
    }

    /**
     * @param GenericPageRequest $pageRequest
     * @return mixed
     */
    public function getAllProducts(GenericPageRequest $pageRequest)
    {
        $models = $this->_productRepository->pushCriteria(new GetAllProductCriteria($pageRequest->getSearch()))
            ->pushCriteria(new GetProductByProductTypeIdCriteria($pageRequest->getCustom()->product_type_id))
            ->pushCriteria(new GetProductByProductGenreIdCriteria($pageRequest->getCustom()->product_genre_id))
            ->with(['product_type', 'product_genre'])
            ->orderBy($pageRequest->columns[$pageRequest->order['column']]['name'], $pageRequest->order['dir'])
            ->groupBy('products.id');

        //$all = $models->fetchAll($reset = false)->count();
        $models = $models->simplePagination($pageRequest->getLength());

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => (int)$model->id,
                'product_type_id' => (int)$model->product_type_id,
                'publish' => date('F, d Y', strtotime($model->publish)),
                'title' => $model->title,
                'featured_image_url' => Config::get('app.url') . $model->featured_image_url,
                'status' => (int)$model->status,
                'product_type' => $model->product_type,
                'product_genre' => $model->product_genre
            ]);

        $this->_genericPageResponse = new GenericPageResponse();
        //$this->_genericPageResponse->setRecordsTotal($all);
        $this->_genericPageResponse->setDto(Collection::make($output));

        return $this->_genericPageResponse;
    }

    /**
     * @param $id
     * @return GenericResponse
     */
    public function getDetailProducts($id)
    {
        $model = $this->_productRepository->skipCriteria()
            ->with(['product_type', 'product_genre', 'product_tag'])->fetchFind($id);

        $output = new Laravel5DTO([
            'id' => (int)$model->id,
            'user_id' => (int)$model->user_id,
            'product_type_id' => (int)$model->product_type_id,
            'product_type' => $model->product_type,
            'publish' => $model->publish,
            'title' => $model->title,
            'slug' => $model->slug,
            'description' => $model->description,
            'featured_image_url' => Config::get('app.url') . $model->featured_image_url,
            'year' => (int)$model->year,
            'rating' => $model->rating,
            'director' => $model->director,
            'duration' => $model->duration,
            'media_type' => $model->media_type,
            'actors' => $model->actors,
            'status' => (int)$model->status,
            'product_genre' => $model->product_genre,
            'product_tag' => $model->product_tag
        ]);


        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }
}
