<?php
namespace App\Services\Implement;


use App\Http\Requests\BlogTag\CreateBlogTagRequest;
use App\Http\Requests\BlogTag\UpdateBlogTagRequest;
use App\Http\Requests\GenericPageRequest;
use App\Http\Responses\BaseResponse;
use App\Http\Responses\GenericPageResponse;
use App\Http\Responses\GenericResponse;
use App\Repositories\Contract\IBlogTagRepository;
use App\Repositories\Criterias\Implement\BlogTag\GetAllBlogTagCriteria;
use App\Repositories\Criterias\Implement\BlogTag\GetBlogTagByNameCriteria;
use App\Services\Contract\IBlogTagService;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Kumuwai\DataTransferObject\Laravel5DTO;

class BlogTagService extends BaseService implements IBlogTagService
{
    private $_blogTagRepository;

    /**
     * TagService constructor.
     * @param IBlogTagRepository $blogTagRepository
     */
    public function __construct(IBlogTagRepository $blogTagRepository)
    {
        $this->_blogTagRepository = $blogTagRepository;
    }

    /**
     * @param GenericPageRequest $pageRequest
     * @return GenericPageResponse
     */
    public function getAll(GenericPageRequest $pageRequest)
    {
        $models = $this->_blogTagRepository->pushCriteria(new GetAllBlogTagCriteria($pageRequest->getSearch()))
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
        $model = $this->_blogTagRepository->skipCriteria()->fetchFind($id);

        $output = new Laravel5DTO([
            'id' => (int)$model->id,
            'name' => $model->name,
            'slug' => $model->slug
        ]);


        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }

    /**
     * @param CreateBlogTagRequest $request
     * @return BaseResponse
     */
    public function save(CreateBlogTagRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $this->_baseResponse->_result = $this->_blogTagRepository->create($request);
                $this->_baseResponse->addSuccessMessage("Blog tag created");

            } catch (Exception $ex) {
                $this->_baseResponse->addErrorMessage($ex->getMessage());

            }
        }

        return $this->_baseResponse;
    }

    /**
     * @param UpdateBlogTagRequest $request
     * @return BaseResponse
     */
    public function update(UpdateBlogTagRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $this->_baseResponse->_result = $this->_blogTagRepository->update($request);
                $this->_baseResponse->addSuccessMessage("Blog tag updated");

            } catch (Exception $ex) {
                $this->_baseResponse->addErrorMessage($ex->getMessage());

            }
        }

        return $this->_baseResponse;
    }

    /**
     * @param $id
     * @return BaseResponse
     */
    public function delete($id)
    {
        $this->_baseResponse = new BaseResponse();

        try {
            $this->_baseResponse->_result = $this->_blogTagRepository->delete($id);
            $this->_baseResponse->addSuccessMessage("Blog tag deleted");

        } catch (Exception $ex) {
            $this->_baseResponse->addErrorMessage($ex->getMessage());
        }

        return $this->_baseResponse;
    }

    /**
     * @param $name
     * @return GenericPageResponse
     */
    public function getBlogTagByName($name)
    {
        $models = $this->_blogTagRepository->pushCriteria(new GetBlogTagByNameCriteria($name));

        $models = $models->fetchAll();

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => $model->id,
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
    public function getBlogTagSlugByName($name)
    {
        $slug = SlugService::createSlug($this->_blogTagRepository->model(), 'slug', $name);

        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->dto = compact('slug');

        return $this->_genericResponse;
    }

}