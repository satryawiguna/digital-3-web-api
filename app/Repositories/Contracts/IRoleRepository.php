<?php
namespace App\Repositories\Contract;


use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;

interface IRoleRepository extends IRepository
{
    /**
     * @return mixed
     */
    public function model();

    /**
     * @param CreateRoleRequest $request
     * @return mixed
     */
    public function create(CreateRoleRequest $request);

    /**
     * @param UpdateRoleRequest $request
     * @return mixed
     */
    public function update(UpdateRoleRequest $request);

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id);
}