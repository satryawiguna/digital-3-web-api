<?php
namespace App\Services\Contract;


use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RecoveryAuthRequest;
use App\Http\Requests\Auth\ResetAuthRequest;
use App\Http\Requests\Auth\SignupAuthRequest;

interface IAuthService
{
    /**
     * @param LoginAuthRequest $request
     * @return mixed
     */
    public function login(LoginAuthRequest $request);

    /**
     * @param SignupAuthRequest $request
     * @return mixed
     */
    public function signup(SignupAuthRequest $request);

    /**
     * @param RecoveryAuthRequest $request
     * @return mixed
     */
    public function recovery(RecoveryAuthRequest $request);

    /**
     * @param ResetAuthRequest $request
     * @return mixed
     */
    public function reset(ResetAuthRequest $request);

    /**
     * @return mixed
     */
    public function getAuthenticatedUser();
}