<?php
namespace App\Repositories\Contract;


use App\Http\Requests\ProductGenre\CreateProductGenreRequest;
use App\Http\Requests\ProductGenre\UpdateProductGenreRequest;

interface IProductGenreRepository
{
    /**
     * @return mixed
     */
    public function model();

    /**
     * @param CreateProductGenreRequest $request
     * @return mixed
     */
    public function create(CreateProductGenreRequest $request);

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
}