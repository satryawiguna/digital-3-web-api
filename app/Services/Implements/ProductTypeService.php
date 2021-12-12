<?php
namespace App\Services\Implement;


use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\ProductType\CreateProductTypeRequest;
use App\Http\Requests\ProductType\UpdateProductTypeRequest;
use App\Http\Responses\BaseResponse;
use App\Http\Responses\GenericPageResponse;
use App\Http\Responses\GenericResponse;
use App\Repositories\Contract\IProductTypeRepository;
use App\Repositories\Criterias\Implement\ProductType\GetAllProductTypeCriteria;
use App\Services\Contract\IProductTypeService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Kumuwai\DataTransferObject\Laravel5DTO;

class ProductTypeService extends BaseService implements IProductTypeService
{
    private $_productTypeRepository;

    /**
     * ProductTypeService constructor.
     * @param IProductTypeRepository $productTypeRepository
     */
    public function __construct(IProductTypeRepository $productTypeRepository)
    {
        $this->_productTypeRepository = $productTypeRepository;
    }

    /**
     * @param GenericPageRequest $pageRequest
     * @return GenericResponse
     */
    public function getAll(GenericPageRequest $pageRequest)
    {
        $models = $this->_productTypeRepository->pushCriteria(new GetAllProductTypeCriteria($pageRequest->getSearch()))
            ->orderBy($pageRequest->columns[$pageRequest->order['column']]['name'], $pageRequest->order['dir']);

        $all = $models->fetchAll($reset = false)->count();
        $models = $models->offsetPagination($pageRequest->getLength(), $pageRequest->getStart());

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => (int)$model->id,
                'name' => $model->name,
                'description' => $model->description
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
        $model = $this->_productTypeRepository->skipCriteria()->fetchFind($id);

        $output = new Laravel5DTO([
            'id' => (int)$model->id,
            'name' => $model->name,
            'description' => $model->description
        ]);


        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }

    /**
     * @param CreateProductTypeRequest $request
     * @return \App\Http\Responses\BaseResponse
     */
    public function save(CreateProductTypeRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $modelByType = $this->_productTypeRepository->skipCriteria()->fetchFindSearch([
                    ['name', 'REGEXP', '[[:<:]]' . $request->getName() . '[[:>:]]']
                ]);

                if ($modelByType->count() == 0) {
                    $this->_baseResponse->_result = $this->_productTypeRepository->create($request);
                    $this->_baseResponse->addSuccessMessage("Product type created");

                } else {
                    $this->_baseResponse->addErrorMessage('Product type is already exists');

                }

            } catch (Exception $ex) {
                $this->_baseResponse->addErrorMessage($ex->getMessage());

            }
        }

        return $this->_baseResponse;
    }

    /**
     * @param UpdateProductTypeRequest $request
     * @return \App\Http\Responses\BaseResponse
     */
    public function update(UpdateProductTypeRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $modelByIdAndType = $this->_productTypeRepository->skipCriteria()->fetchFindSearch([
                    ['id', '<>', $request->getId()],
                    ['name', 'REGEXP', '[[:<:]]' . $request->getName() . '[[:>:]]']
                ]);

                if ($modelByIdAndType->count() == 0) {
                    $this->_baseResponse->_result = $this->_productTypeRepository->update($request);
                    $this->_baseResponse->addSuccessMessage("Product type updated");

                } else {
                    $this->_baseResponse->addErrorMessage('Product type is already exists');

                }

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
            $this->_baseResponse->_result = $this->_productTypeRepository->delete($id);
            $this->_baseResponse->addSuccessMessage("Product type deleted");

        } catch (Exception $ex) {
            $this->_baseResponse->addErrorMessage($ex->getMessage());
        }

        return $this->_baseResponse;
    }

    /**
     * @return GenericResponse
     */
    public function getProductTypeList()
    {
        $models = $this->_productTypeRepository->skipCriteria()
            ->orderBy('name', 'asc')
            ->fetchAll();

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => (int)$model->id,
                'name' => $model->name,
                'description' => $model->description
            ]);

        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }

    /**
     * @return GenericResponse
     */
    public function getAllProductTypes()
    {
        $models = $this->_productTypeRepository->skipCriteria()
            ->orderBy('name', 'asc')
            ->fetchAll();

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => (int)$model->id,
                'name' => $model->name,
                'description' => $model->description
            ]);

        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }
}