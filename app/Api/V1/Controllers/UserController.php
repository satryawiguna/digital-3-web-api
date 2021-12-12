<?php

namespace App\Api\V1\Controllers;

use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\Role\RoleRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Services\Contract\IUserService;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    private $_userService;

    private $_request;

    private $_createUserRequest;

    private $_roleRequest;

    private $_updateUserRequest;

    /**
     * CountryController constructor.
     * @param Request $request
     * @param IUserService $userService
     */
    public function __construct(Request $request, IUserService $userService)
    {
        $this->_request = $request;

        $this->_userService = $userService;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetail($id)
    {
        $result = $this->_userService->getDetail($id);

        return response()->json($result);
    }

    public function save()
    {

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function update()
    {
        $this->_roleRequest = new RoleRequest();

        $this->_roleRequest->role_id = $this->_request->input('role.id');

        $this->_updateUserRequest = new UpdateUserRequest();

        $this->_updateUserRequest->id = $this->_request->input('id');
        $this->_updateUserRequest->email = $this->_request->input('email');
        $this->_updateUserRequest->password = $this->_request->input('password');
        $this->_updateUserRequest->password_confirmation = $this->_request->input('password_confirmation');
        $this->_updateUserRequest->handphone_code_id = $this->_request->input('handphone_code_id');
        $this->_updateUserRequest->handphone = $this->_request->input('handphone');
        $this->_updateUserRequest->status = $this->_request->input('status');
        $this->_updateUserRequest->role = $this->_roleRequest;

        $result = $this->_userService->update($this->_updateUserRequest);

        return response()->json($result);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserActivate($id)
    {
        $result = $this->_userService->userActivate($id);

        return response()->json($result);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserByEmail()
    {
        $email = $this->_request->get('email');

        $result = $this->_userService->getUserByEmail($email);

        return response()->json($result);
    }
}
