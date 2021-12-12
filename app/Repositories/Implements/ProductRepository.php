<?php
namespace App\Repositories\Implement;


use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Repositories\Contract\IProductRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ProductRepository extends BaseRepository implements IProductRepository
{
    /**
     * ProductRepository constructor.
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
        return 'App\Models\Product';
    }

    /**
     * @param CreateProductRequest $request
     * @return int|mixed
     */
    public function create(CreateProductRequest $request)
    {
        $product = $this->_model;

        $product->user_id = $request->getUserId();
        $product->product_type_id = $request->getProductTypeId();
        $product->publish = $request->getPublish();
        $product->title = $request->getTitle();
        $product->slug = $request->getSlug();
        $product->description = $request->getDescription();
        $product->featured_image_url = $request->getFeaturedImageUrl();
        $product->year = $request->getYear();
        $product->rating = $request->getRating();
        $product->director = $request->getDirector();
        $product->duration = $request->getDuration();
        $product->media_type = $request->getMediaType();
        $product->actors = $request->getActors();
        $product->status = $request->getStatus();
        $product->created_at = Carbon::now();

        $result = $product->save() ? $product->id : 0;

        $product->product_tag()->attach($request->getProductTag());
        $product->product_genre()->attach($request->getProductGenre());

        return $result;
    }

    /**
     * @param UpdateProductRequest $request
     * @return int
     */
    public function update(UpdateProductRequest $request)
    {
        $product = $this->_model->find($request->getId());

        $product->user_id = $request->getUserId();
        $product->product_type_id = $request->getProductTypeId();
        $product->title = $request->getTitle();
        $product->slug = $request->getSlug();
        $product->description = $request->getDescription();
        $product->featured_image_url = $request->getFeaturedImageUrl();
        $product->year = $request->getYear();
        $product->rating = $request->getRating();
        $product->director = $request->getDirector();
        $product->duration = $request->getDuration();
        $product->media_type = $request->getMediaType();
        $product->actors = $request->getActors();
        $product->status = $request->getStatus();
        $product->updated_at = Carbon::now();

        $result = $product->save() ? $product->id : 0;

        $product->product_tag()->sync($request->getProductTag());
        $product->product_genre()->sync($request->getProductGenre());

        return $result;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $product = $this->_model->whereId($id);

        return $product->delete();
    }
}