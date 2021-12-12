<?php
namespace App\Repositories\Contract;


use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

interface IUserRepository extends IRepository
{
    /**
     * @return mixed
     */
    public function model();

    /**
     * @param CreateUserRequest $request
     * @return mixed
     */
    public function create(CreateUserRequest $request);

    /**
     * @param UpdateUserRequest $request
     * @return mixed
     */
    public function update(UpdateUserRequest $request);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);

    /**
     * @param $id
     * @return mixed
     */
    public function userActivate($id);
}