<?php
namespace App\Api\V1\Controllers;


use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Services\Contract\IRoleService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $_roleService;

    private $_request;

    private $_createRoleRequest;

    private $_updateRoleRequest;

    /**
     * RoleController constructor.
     * @param Request $request
     * @param IRoleService $roleService
     */
    public function __construct(Request $request, IRoleService $roleService)
    {
        $this->_request = $request;

        $this->_roleService = $roleService;
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $pageRequest = new GenericPageRequest();

        $pageRequest->draw = $this->_request->get('draw');
        $pageRequest->start = $this->_request->get('start');
        $pageRequest->length = $this->_request->get('length');

        $order[0]['column'] = $this->_request->get('order')[0]['column'];
        $order[0]['dir'] = $this->_request->get('order')[0]['dir'];
        $pageRequest->order = $order[0];

        $columns[0]['name'] = $this->_request->get('columns')[0]['name'];
        $columns[1]['name'] = $this->_request->get('columns')[1]['name'];
        $pageRequest->columns = $columns;

        $pageRequest->search = $this->_request->get('search')['value'];

        $result = $this->_roleService->getAll($pageRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetail($id)
    {
        $result = $this->_roleService->getDetail($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $this->_createRoleRequest = new CreateRoleRequest();

        $this->_createRoleRequest->role = $this->_request->input('role');
        $this->_createRoleRequest->description = $this->_request->input('description');

        $result = $this->_roleService->save($this->_createRoleRequest);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $this->_updateRoleRequest = new UpdateRoleRequest();

        $this->_updateRoleRequest->id = $this->_request->input('id');
        $this->_updateRoleRequest->role = $this->_request->input('role');
        $this->_updateRoleRequest->description = $this->_request->input('description');

        $result = $this->_roleService->update($this->_updateRoleRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $result = $this->_roleService->delete($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRoleList()
    {
        $result = $this->_roleService->getRoleList();

        return response()->json($result);
    }
}
