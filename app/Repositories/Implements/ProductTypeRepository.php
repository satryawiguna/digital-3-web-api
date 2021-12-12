<?php
namespace App\Repositories\Implement;


use App\Http\Requests\ProductType\CreateProductTypeRequest;
use App\Http\Requests\ProductType\UpdateProductTypeRequest;
use App\Repositories\Contract\IProductTypeRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ProductTypeRepository extends BaseRepository implements IProductTypeRepository
{
    /**
     * ProductTypeRepository constructor.
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
        return 'App\Models\ProductType';
    }

    /**
     * @param CreateProductTypeRequest $request
     * @return int|mixed
     */
    public function create(CreateProductTypeRequest $request)
    {
        $productType = $this->_model;

        $productType->name = $request->getName();
        $productType->description = $request->getDescription();
        $productType->created_at = Carbon::now();

        return $productType->save() ? $productType->id : 0;
    }

    /**
     * @param UpdateProductTypeRequest $request
     * @return int
     */
    public function update(UpdateProductTypeRequest $request)
    {
        $productType = $this->_model->find($request->getId());

        $productType->name = $request->getName();
        $productType->description = $request->getDescription();
        $productType->updated_at = Carbon::now();

        return $productType->save() ? $productType->id : 0;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $productType = $this->_model->whereId($id);

        return $productType->delete();
    }
}