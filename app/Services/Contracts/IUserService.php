<?php
namespace App\Services\Contract;


use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

interface IUserService
{
    /**
     * @param $id
     * @return mixed
     */
    public function getDetail($id);

    /**
     * @param CreateUserRequest $request
     * @return mixed
     */
    public function save(CreateUserRequest $request);

    /**
     * @param UpdateUserRequest $request
     * @return mixed
     */
    public function update(UpdateUserRequest $request);

    /**
     * @param $id
     * @return mixed
     */
    public function userActivate($id);

    /**
     * @param $email
     * @return mixed
     */
    public function getUserByEmail($email);
}