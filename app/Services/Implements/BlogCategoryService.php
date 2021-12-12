<?php
namespace App\Services\Implement;


use App\Http\Requests\BlogCategory\CreateBlogCategoryRequest;
use App\Http\Requests\BlogCategory\UpdateBlogCategoryRequest;
use App\Http\Requests\GenericPageRequest;
use App\Http\Responses\BaseResponse;
use App\Http\Responses\GenericPageResponse;
use App\Http\Responses\GenericResponse;
use App\Repositories\Contract\IBlogCategoryRepository;
use App\Repositories\Criterias\Implement\BlogCategory\GetAllBlogCategoryCriteria;
use App\Repositories\Criterias\Implement\BlogCategory\GetBlogCategoryByNameCriteria;
use App\Repositories\Criterias\Implement\BlogCategory\GetBlogCategoryByParentId;
use App\Services\Contract\IBlogCategoryService;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Kumuwai\DataTransferObject\Laravel5DTO;

class BlogCategoryService extends BaseService implements IBlogCategoryService
{
    private $_blogCategoryRepository;

    /**
     * BlogCategoryService constructor.
     * @param IBlogCategoryRepository $blogCategoryRepository
     */
    public function __construct(IBlogCategoryRepository $blogCategoryRepository)
    {
        $this->_blogCategoryRepository = $blogCategoryRepository;
    }

    /**
     * @param GenericPageRequest $pageRequest
     * @return GenericResponse
     */
    public function getAll(GenericPageRequest $pageRequest)
    {
        $models = $this->_blogCategoryRepository->pushCriteria(new GetAllBlogCategoryCriteria($pageRequest->getSearch()))
            ->pushCriteria(new GetBlogCategoryByParentId($pageRequest->getCustom()->parent_id))
            ->orderBy($pageRequest->columns[$pageRequest->order['column']]['name'], $pageRequest->order['dir']);

        $all = $models->fetchAll()->count();
        $models = $models->offsetPagination($pageRequest->getLength(), $pageRequest->getStart());

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => (int)$model->id,
                'parent_id' => (int)$model->parent_id,
                'parent' => $model->parent,
                'name' => $model->name,
                'slug' => $model->slug,
                'description' => $model->description,
                'child' => $model->child
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
        $model = $this->_blogCategoryRepository->skipCriteria()
            ->with(['parent'])
            ->fetchFind($id);

        $output = new Laravel5DTO([
            'id' => (int)$model->id,
            'parent_id' => (int)$model->parent_id ? $model->parent_id : null,
            'parent' => $model->parent ? $model->parent->name : null,
            'name' => $model->name,
            'slug' => $model->slug,
            'description' => $model->description
        ]);


        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }

    /**
     * @param CreateBlogCategoryRequest $request
     * @return \App\Http\Responses\BaseResponse
     */
    public function save(CreateBlogCategoryRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $this->_baseResponse->_result = $this->_blogCategoryRepository->create($request);
                $this->_baseResponse->addSuccessMessage("Blog category created");

            } catch (Exception $ex) {
                $this->_baseResponse->addErrorMessage($ex->getMessage());

            }
        }

        return $this->_baseResponse;
    }

    /**
     * @param UpdateBlogcategoryRequest $request
     * @return \App\Http\Responses\BaseResponse
     */
    public function update(UpdateBlogcategoryRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $this->_baseResponse->_result = $this->_blogCategoryRepository->update($request);
                $this->_baseResponse->addSuccessMessage("Blog category updated");

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
            $this->_baseResponse->_result = $this->_blogCategoryRepository->delete($id);
            $this->_baseResponse->addSuccessMessage("Blog category deleted");

        } catch (Exception $ex) {
            $this->_baseResponse->addErrorMessage($ex->getMessage());
        }

        return $this->_baseResponse;
    }

    /**
     * @param $id
     * @param $name
     * @return GenericPageResponse
     */
    public function getBlogCategoryByName($id, $name)
    {
        $models = $this->_blogCategoryRepository->pushCriteria(new GetBlogCategoryByNameCriteria($id, $name));

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
     * @return GenericResponse
     */
    public function getBlogCategoryList()
    {
        $models = $this->_blogCategoryRepository->skipCriteria()
            ->with(['parent']);
        $models = $models->orderBy('name', 'asc');
        $models = $models->fetchAll();

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => (int)$model->id,
                'parent_id' => $model->parent_id ? (int)$model->parent_id : null,
                'parent' => $model->parent ? $model->parent->name : null,
                'name' => $model->name,
                'slug' => $model->slug,
                'description' => $model->description
            ]);

        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }

    /**
     * @return GenericResponse
     */
    public function getBlogCategoryHierarchy()
    {
        $models = $this->_blogCategoryRepository->skipCriteria();
        $models = $models->fetchAll();

        $output = $this->builtHierarchy($models);

        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getBlogCategorySlugByName($name)
    {
        $slug = SlugService::createSlug($this->_blogCategoryRepository->model(), 'slug', $name);

        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->dto = compact('slug');

        return $this->_genericResponse;
    }

    /**
     * @param $models
     * @param null $parent
     * @return array
     */
    private function builtHierarchy($models, $parent = null)
    {
        $output = [];

        foreach($models as $model) {
            if ($model->parent_id == $parent) {

                $output[] = new Laravel5DTO([
                    'id' => (int)$model->id,
                    'parent_id' => $model->parent_id ? (int)$model->parent_id : null,
                    'parent' => $model->parent ? $model->parent->name : null,
                    'name' => $model->name,
                    'slug' => $model->slug,
                    'description' => $model->description,
                    'dto' => ($this->hasChildren($models, $model->id)) ? $this->builtHierarchy($models, $model->id) : null
                ]);
            }
        }

        return $output;
    }

    /**
     * @param $models
     * @param $id
     * @return bool
     */
    private function hasChildren($models, $id)
    {
        foreach ($models as $model) {
            if ($model->id == $id)
                return true;
        }

        return false;
    }
}