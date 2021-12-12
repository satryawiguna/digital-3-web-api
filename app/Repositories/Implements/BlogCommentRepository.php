<?php
namespace App\Repositories\Implement;


use App\Http\Requests\BlogComment\CreateBlogCommentRequest;
use App\Http\Requests\BlogComment\UpdateBlogCommentRequest;
use App\Repositories\Contract\IBlogCommentRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class BlogCommentRepository extends BaseRepository implements IBlogCommentRepository
{
    /**
     * BlogCommentRepository constructor.
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
        return 'App\Models\BlogComment';
    }

    /**
     * @param CreateBlogCommentRequest $request
     * @return int|mixed
     */
    public function create(CreateBlogCommentRequest $request)
    {
        $blogComment = $this->_model;

        $blogComment->blog_id = $request->getBlogId();
        $blogComment->user_id = $request->getUserId();
        $blogComment->comment = $request->getComment();
        $blogComment->ip_address = $request->getIpAddress();
        $blogComment->browser = $request->getBrowser();
        $blogComment->created_at = Carbon::now();

        return $blogComment->save() ? $blogComment->id : 0;
    }

    /**
     * @param UpdateBlogCommentRequest $request
     * @return int
     */
    public function update(UpdateBlogCommentRequest $request)
    {
        $blogComment = $this->_model->find($request->getId());

        $blogComment->blog_id = $request->getBlogId();
        $blogComment->user_id = $request->getUserId();
        $blogComment->comment = $request->getComment();
        $blogComment->ip_address = $request->getIpAddress();
        $blogComment->browser = $request->getBrowser();
        $blogComment->updated_at = Carbon::now();

        return $blogComment->save() ? $blogComment->id : 0;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $blogComment = $this->_model->whereId($id);

        return $blogComment->delete();
    }
}