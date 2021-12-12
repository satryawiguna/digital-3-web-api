<?php
namespace App\Repositories\Implement;


use App\Http\Requests\ProductGenre\CreateProductGenreRequest;
use App\Http\Requests\ProductGenre\UpdateProductGenreRequest;
use App\Repositories\Contract\IProductGenreRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class ProductGenreRepository extends BaseRepository implements IProductGenreRepository
{
    /**
     * ProductGenreRepository constructor.
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
        return 'App\Models\ProductGenre';
    }

    /**
     * @param CreateProductGenreRequest $request
     * @return int|mixed
     */
    public function create(CreateProductGenreRequest $request)
    {
        $productGenre = $this->_model;

        $productGenre->parent_id = $request->getParentId();
        $productGenre->name = $request->getName();
        $productGenre->slug = $request->getSlug();
        $productGenre->description = $request->getDescription();
        $productGenre->created_at = Carbon::now();

        return $productGenre->save() ? $productGenre->id : 0;
    }

    /**
     * @param UpdateProductGenreRequest $request
     * @return int
     */
    public function update(UpdateProductGenreRequest $request)
    {
        $productGenre = $this->_model->find($request->getId());

        $productGenre->parent_id = $request->getParentId();
        $productGenre->name = $request->getName();
        $productGenre->slug = $request->getSlug();
        $productGenre->description = $request->getDescription();
        $productGenre->updated_at = Carbon::now();

        return $productGenre->save() ? $productGenre->id : 0;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $productGenre = $this->_model->whereId($id);

        return $productGenre->delete();
    }
}