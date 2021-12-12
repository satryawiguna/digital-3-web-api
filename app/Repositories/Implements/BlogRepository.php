<?php
namespace App\Repositories\Implement;


use App\Http\Requests\Blog\CreateBlogRequest;
use App\Http\Requests\Blog\UpdateBlogRequest;
use App\Repositories\Contract\IBlogRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BlogRepository extends BaseRepository implements IBlogRepository
{
    /**
     * BlogRepository constructor.
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
        return 'App\Models\Blog';
    }

    /**
     * @param CreateBlogRequest $request
     * @return int|mixed
     */
    public function create(CreateBlogRequest $request)
    {
        $blog = $this->_model;

        $blog->user_id = $request->getUserId();
        $blog->publish = $request->getPublish();
        $blog->title = $request->getTitle();
        $blog->slug = $request->getSlug();
        $blog->contents = $request->getContents();
        $blog->featured_image_url = $request->getFeaturedImageUrl();
        $blog->status = $request->getStatus();
        $blog->created_at = Carbon::now();

        $result = $blog->save() ? $blog->id : 0;

        $blog->blog_category()->attach($request->getBlogCategory());
        $blog->blog_tag()->attach($request->getBlogTag());

        return $result;
    }

    /**
     * @param UpdateBlogRequest $request
     * @return int
     */
    public function update(UpdateBlogRequest $request)
    {
        $blog = $this->_model->find($request->getId());

        $blog->user_id = $request->getUserId();
        $blog->title = $request->getTitle();
        $blog->slug = $request->getSlug();
        $blog->contents = $request->getContents();
        $blog->featured_image_url = $request->getFeaturedImageUrl();
        $blog->status = $request->getStatus();
        $blog->updated_at = Carbon::now();

        $result = $blog->save() ? $blog->id : 0;

        $blog->blog_category()->sync($request->getBlogCategory());
        $blog->blog_tag()->sync($request->getBlogTag());

        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $blog = $this->_model->whereId($id);

        return $blog->delete();
    }
}