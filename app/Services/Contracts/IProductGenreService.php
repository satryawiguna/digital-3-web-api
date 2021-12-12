<?php
namespace App\Services\Contract;


use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\ProductGenre\CreateProductGenreRequest;
use App\Http\Requests\ProductGenre\UpdateProductGenreRequest;

interface IProductGenreService
{
    /**
     * @param GenericPageRequest $pageRequest
     * @return mixed
     */
    public function getAll(GenericPageRequest $pageRequest);

    /**
     * @param $id
     * @return mixed
     */
    public function getDetail($id);

    /**
     * @param CreateProductGenreRequest $request
     * @return mixed
     */
    public function save(CreateProductGenreRequest $request);

    /**
     * @param UpdateProductGenreRequest $request
     * @return mixed
     */
    public function update(UpdateProductGenreRequest $request);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @return mixed
     */
    public function getProductGenreList();

    /**
     * @return mixed
     */
    public function getProductGenreHierarchy();

    /**
     * @param $name
     * @return mixed
     */
    public function getProductGenreSlugByName($name);

    /**
     * @return mixed
     */
    public function getAllProductGenres($id);
}