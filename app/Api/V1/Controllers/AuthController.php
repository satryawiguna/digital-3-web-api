<?php
namespace App\Api\V1\Controllers;


use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RecoveryAuthRequest;
use App\Http\Requests\Auth\SignupAuthRequest;
use App\Services\Contract\IAuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $_authService;

    /**
     * AuthController constructor.
     * @param IAuthService $authService
     */
    public function __construct(IAuthService $authService)
    {
        $this->_authService = $authService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $loginAuthRequest = new LoginAuthRequest();

        $loginAuthRequest->email = $request->input('email');
        $loginAuthRequest->password = $request->input('password');

        $result = $this->_authService->login($loginAuthRequest);

        return response()->json($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function signup(Request $request)
    {
        $signupAuthRequest = new SignupAuthRequest();

        $signupAuthRequest->email = $request->input('email');
        $signupAuthRequest->password = \Hash::make($request->input('password'));

        $result = $this->_authService->signup($signupAuthRequest);

        return response()->json($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recovery(Request $request)
    {
        $recoveryAuthRequest = new RecoveryAuthRequest();

        $recoveryAuthRequest->email = $request->input('email');

        $result = $this->_authService->recovery($recoveryAuthRequest);

        return response()->json($result);
    }

    /**
     * @return mixed
     */
    public function reset()
    {
        $result = $this->_authService->reset($this->_request);

        return $result;
    }

    /**
     * @return mixed
     */
    public function getAuthenticatedUser()
    {
        $result = $this->_authService->getAuthenticatedUser();

        return $result;
    }
}