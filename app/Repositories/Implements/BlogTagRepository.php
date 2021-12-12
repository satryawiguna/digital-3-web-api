<?php
namespace App\Repositories\Implement;


use App\Http\Requests\BlogTag\CreateBlogTagRequest;
use App\Http\Requests\BlogTag\UpdateBlogTagRequest;
use App\Repositories\Contract\IBlogTagRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BlogTagRepository extends BaseRepository implements IBlogTagRepository
{
    /**
     * BlogTagRepository constructor.
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
        return 'App\Models\BlogTag';
    }

    /**
     * @param CreateBlogTagRequest $request
     * @return int|mixed
     */
    public function create(CreateBlogTagRequest $request)
    {
        $blogTag = $this->_model;

        $blogTag->name = $request->getName();
        $blogTag->slug = $request->getSlug();
        $blogTag->created_at = Carbon::now();

        return $blogTag->save() ? $blogTag->id : 0;
    }

    /**
     * @param UpdateBlogTagRequest $request
     * @return int
     */
    public function update(UpdateBlogTagRequest $request)
    {
        $blogTag = $this->_model->find($request->getId());

        $blogTag->name = $request->getName();
        $blogTag->slug = $request->getSlug();
        $blogTag->updated_at = Carbon::now();

        return $blogTag->save() ? $blogTag->id : 0;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $blogTag = $this->_model->whereId($id);

        return $blogTag->delete();
    }
}