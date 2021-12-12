<?php
namespace App\Services\Contract;


use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;

interface IRoleService
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
     * @param CreateRoleRequest $request
     * @return mixed
     */
    public function save(CreateRoleRequest $request);

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

    /**
     * @return mixed
     */
    public function getRoleList();
}