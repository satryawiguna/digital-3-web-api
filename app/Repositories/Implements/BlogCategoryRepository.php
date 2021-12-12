<?php
namespace App\Repositories\Implement;


use App\Http\Requests\BlogCategory\CreateBlogCategoryRequest;
use App\Http\Requests\BlogCategory\UpdateBlogCategoryRequest;
use App\Repositories\Contract\IBlogCategoryRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BlogCategoryRepository extends BaseRepository implements IBlogCategoryRepository
{
    /**
     * BlogCategoryRepository constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_criteria = new Collection();
    }

    /**
     *
     */
    public function model()
    {
        return 'App\Models\BlogCategory';
    }

    /**
     * @param CreateBlogCategoryRequest $request
     * @return int|mixed
     */
    public function create(CreateBlogCategoryRequest $request)
    {
        $blogCategory = $this->_model;

        $blogCategory->parent_id = $request->getParentId();
        $blogCategory->name = $request->getName();
        $blogCategory->slug = $request->getSlug();
        $blogCategory->description = $request->getDescription();
        $blogCategory->created_at = Carbon::now();

        return $blogCategory->save() ? $blogCategory->id : 0;
    }

    /**
     * @param UpdateBlogCategoryRequest $request
     * @return int
     */
    public function update(UpdateBlogCategoryRequest $request)
    {
        $blogCategory = $this->_model->find($request->getId());

        $blogCategory->parent_id = $request->getParentId();
        $blogCategory->name = $request->getName();
        $blogCategory->slug = $request->getSlug();
        $blogCategory->description = $request->getDescription();
        $blogCategory->updated_at = Carbon::now();

        return $blogCategory->save() ? $blogCategory->id : 0;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $blogCategory = $this->_model->whereId($id);

        return $blogCategory->delete();
    }
}