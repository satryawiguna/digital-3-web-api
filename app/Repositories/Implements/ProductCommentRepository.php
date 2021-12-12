<?php
namespace App\Repositories\Implement;


use App\Http\Requests\ProductComment\CreateProductCommentRequest;
use App\Http\Requests\ProductComment\UpdateProductCommentRequest;
use App\Repositories\Contract\IProductCommentRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ProductCommentRepository extends BaseRepository implements IProductCommentRepository
{
    /**
     * ProductCommentRepository constructor.
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
        return 'App\Models\ProductComment';
    }

    /**
     * @param CreateProductCommentRequest $request
     * @return int|mixed
     */
    public function create(CreateProductCommentRequest $request)
    {
        $blogComment = $this->_model;

        $blogComment->product_id = $request->getProductId();
        $blogComment->user_id = $request->getUserId();
        $blogComment->comment = $request->getComment();
        $blogComment->ip_address = $request->getIpAddress();
        $blogComment->browser = $request->getBrowser();
        $blogComment->created_at = Carbon::now();

        return $blogComment->save() ? $blogComment->id : 0;
    }

    /**
     * @param UpdateProductCommentRequest $request
     * @return int
     */
    public function update(UpdateProductCommentRequest $request)
    {
        $blogComment = $this->_model->find($request->getId());

        $blogComment->product_id = $request->getProductId();
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