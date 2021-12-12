<?php
namespace App\Services\Implement;


use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\ProductTag\CreateProductTagRequest;
use App\Http\Requests\ProductTag\UpdateProductTagRequest;
use App\Http\Responses\BaseResponse;
use App\Http\Responses\GenericPageResponse;
use App\Http\Responses\GenericResponse;
use App\Repositories\Contract\IProductTagRepository;
use App\Repositories\Criterias\Implement\ProductTag\GetAllProductTagCriteria;
use App\Repositories\Criterias\Implement\ProductTag\GetProductTagByAgentIdCriteria;
use App\Repositories\Criterias\Implement\ProductTag\GetProductTagByNameCriteria;
use App\Services\Contract\IProductTagService;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Kumuwai\DataTransferObject\Laravel5DTO;

class ProductTagService extends BaseService implements IProductTagService
{
    private $_productTagRepository;

    /**
     * TagService constructor.
     * @param IProductTagRepository $productTagRepository
     */
    public function __construct(IProductTagRepository $productTagRepository)
    {
        $this->_productTagRepository = $productTagRepository;
    }

    /**
     * @param GenericPageRequest $pageRequest
     * @return GenericResponse
     */
    public function getAll(GenericPageRequest $pageRequest)
    {
        $models = $this->_productTagRepository->pushCriteria(new GetAllProductTagCriteria($pageRequest->getSearch()))
            ->orderBy($pageRequest->columns[$pageRequest->order['column']]['name'], $pageRequest->order['dir']);

        $all = $models->fetchAll($reset = false)->count();
        $models = $models->offsetPagination($pageRequest->getLength(), $pageRequest->getStart());

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => (int)$model->id,
                'name' => $model->name,
                'slug' => $model->slug
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
        $model = $this->_productTagRepository->skipCriteria()->fetchFind($id);

        $output = new Laravel5DTO([
            'id' => (int)$model->id,
            'agent_id' => (int)$model->agent_id,
            'name' => $model->name,
            'slug' => $model->slug
        ]);


        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }

    /**
     * @param CreateProductTagRequest $request
     * @return \App\Http\Responses\BaseResponse
     */
    public function save(CreateProductTagRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $this->_baseResponse->_result = $this->_productTagRepository->create($request);
                $this->_baseResponse->addSuccessMessage("Product tag created");

            } catch (Exception $ex) {
                $this->_baseResponse->addErrorMessage($ex->getMessage());

            }
        }

        return $this->_baseResponse;
    }

    /**
     * @param UpdateProductTagRequest $request
     * @return \App\Http\Responses\BaseResponse
     */
    public function update(UpdateProductTagRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $this->_baseResponse->_result = $this->_productTagRepository->update($request);
                $this->_baseResponse->addSuccessMessage("Product tag updated");

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
            $this->_baseResponse->_result = $this->_productTagRepository->delete($id);
            $this->_baseResponse->addSuccessMessage("Product tag deleted");

        } catch (Exception $ex) {
            $this->_baseResponse->addErrorMessage($ex->getMessage());
        }

        return $this->_baseResponse;
    }

    /**
     * @param $name
     * @return GenericPageResponse
     */
    public function getProductTagByName($name)
    {
        $models = $this->_productTagRepository->pushCriteria(new GetProductTagByNameCriteria($name));
        $models = $models->fetchAll();

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => (int)$model->id,
                'name' => $model->name
            ]);

        $this->_genericPageResponse = new GenericPageResponse();
        $this->_genericPageResponse->setDto(Collection::make($output));

        return $this->_genericPageResponse;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getProductTagSlugByName($name)
    {
        $slug = SlugService::createSlug($this->_productTagRepository->model(), 'slug', $name);

        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->dto = compact('slug');

        return $this->_genericResponse;
    }
}