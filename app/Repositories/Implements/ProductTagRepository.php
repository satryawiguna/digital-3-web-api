<?php
namespace App\Repositories\Implement;


use App\Http\Requests\ProductTag\CreateProductTagRequest;
use App\Http\Requests\ProductTag\UpdateProductTagRequest;
use App\Repositories\Contract\IProductTagRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ProductTagRepository extends BaseRepository implements IProductTagRepository
{
    /**
     * ProductTagRepository constructor.
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
        return 'App\Models\ProductTag';
    }

    /**
     * @param CreateProductTagRequest $request
     * @return int|mixed
     */
    public function create(CreateProductTagRequest $request)
    {
        $productTag = $this->_model;

        $productTag->name = $request->getName();
        $productTag->slug = $request->getSlug();
        $productTag->created_at = Carbon::now();

        return $productTag->save() ? $productTag->id : 0;
    }

    /**
     * @param UpdateProductTagRequest $request
     * @return int
     */
    public function update(UpdateProductTagRequest $request)
    {
        $productTag = $this->_model->find($request->getId());

        $productTag->name = $request->getName();
        $productTag->slug = $request->getSlug();
        $productTag->updated_at = Carbon::now();

        return $productTag->save() ? $productTag->id : 0;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $productTag = $this->_model->whereId($id);

        return $productTag->delete();
    }
}