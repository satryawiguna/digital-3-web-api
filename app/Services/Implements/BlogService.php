<?php
namespace App\Services\Implement;


use App\Http\Requests\Blog\CreateBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Http\Requests\GenericPageRequest;
use App\Http\Responses\BaseResponse;
use App\Http\Responses\GenericPageResponse;
use App\Http\Responses\GenericResponse;
use App\Repositories\Contract\IBlogRepository;
use App\Repositories\Criterias\Implement\Blog\GetAllBlogCriteria;
use App\Repositories\Criterias\Implement\Blog\GetBlogByBlogCategoryIdCriteria;
use App\Repositories\Criterias\Implement\Blog\GetBlogByBlogTagIdCriteria;
use App\Services\Contract\IBlogService;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Kumuwai\DataTransferObject\Laravel5DTO;

class BlogService extends BaseService implements IBlogService
{
    private $_blogRepository;

    /**
     * BlogService constructor.
     * @param IBlogRepository $blogRepository
     */
    public function __construct(IBlogRepository $blogRepository)
    {
        $this->_blogRepository = $blogRepository;
    }

    /**
     * @param GenericPageRequest $pageRequest
     * @return GenericResponse
     */
    public function getAll(GenericPageRequest $pageRequest)
    {
        $models = $this->_blogRepository->pushCriteria(new GetAllBlogCriteria($pageRequest->getSearch()))
            ->pushCriteria(new GetBlogByBlogCategoryIdCriteria($pageRequest->getCustom()->blog_category_id))
            ->pushCriteria(new GetBlogByBlogTagIdCriteria($pageRequest->getCustom()->blog_tag_id))
            ->with(['blog_category', 'blog_tag'])
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
                'blog_category' => $model->blog_category,
                'blog_tag' => $model->blog_tag
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
        $model = $this->_blogRepository->skipCriteria()
            ->with(['blog_category', 'blog_tag'])->fetchFind($id);

        $output = new Laravel5DTO([
            'id' => (int)$model->id,
            'user_id' => (int)$model->user_id,
            'publish' => $model->publish,
            'title' => $model->title,
            'slug' => $model->slug,
            'contents' => $model->contents,
            'featured_image_url' => $model->featured_image_url,
            'status' => (int)$model->status,
            'blog_category' => $model->blog_category,
            'blog_tag' => $model->blog_tag
        ]);


        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }

    /**
     * @param CreateBlogRequest $request
     * @return \App\Http\Responses\BaseResponse
     */
    public function save(CreateBlogRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $this->_baseResponse->_result = $this->_blogRepository->create($request);
                $this->_baseResponse->addSuccessMessage("Blog created");

            } catch (Exception $ex) {
                $this->_baseResponse->addErrorMessage($ex->getMessage());

            }
        }

        return $this->_baseResponse;
    }

    /**
     * @param UpdateBlogRequest $request
     * @return \App\Http\Responses\BaseResponse
     */
    public function update(UpdateBlogRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $this->_baseResponse->_result = $this->_blogRepository->update($request);
                $this->_baseResponse->addSuccessMessage("Blog updated");

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
            $this->_baseResponse->_result = $this->_blogRepository->delete($id);
            $this->_baseResponse->addSuccessMessage("Blog deleted");

        } catch (Exception $ex) {
            $this->_baseResponse->addErrorMessage($ex->getMessage());
        }

        return $this->_baseResponse;
    }

    /**
     * @param $title
     * @return mixed
     */
    public function getBlogSlugByTitle($title)
    {
        $slug = SlugService::createSlug($this->_blogRepository->model(), 'slug', $title);

        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->dto = compact('slug');

        return $this->_genericResponse;
    }
}