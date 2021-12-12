<?php
namespace App\Services\Implement;


use App\Events\SendEmailEvent;
use App\Http\Requests\Auth\LoginAuthRequest;
use App\Http\Requests\Auth\RecoveryAuthRequest;
use App\Http\Requests\Auth\ResetAuthRequest;
use App\Http\Requests\Auth\SignupAuthRequest;
use App\Http\Responses\GenericResponse;
use App\Libraries\Crypt;
use App\Repositories\Contract\IAuthRepository;
use App\Repositories\Contract\IUserRepository;
use App\Services\Contract\IAuthService;
use Dingo\Api\Exception\ValidationHttpException;
use Dingo\Api\Routing\Helpers;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService extends BaseService implements IAuthService
{
    use Helpers;

    private $_authRepository;

    private $_userRepository;

    /**
     * AuthService constructor.
     * @param IAuthRepository $authRepository
     * @param IUserRepository $userRepository
     */
    public function __construct(IAuthRepository $authRepository, IUserRepository $userRepository)
    {
        $this->_authRepository = $authRepository;

        $this->_userRepository = $userRepository;
    }

    /**
     * @param LoginAuthRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginAuthRequest $request)
    {
        $credentials = [
            'email' => $request->getEmail(),
            'password' => $request->getPassword()
        ];
        $validator = Validator::make($credentials, $request->rules());

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->response->errorUnauthorized();
            }

        } catch (JWTException $ex) {
            return $this->response->error('Could not create token', 500);
        }

        $user =  $this->_userRepository->skipCriteria()->with(['role'])->fetchFindSearch(['email' => $request->getEmail()])->first();
        $user_id = $user->id;
        $email = $user->email;

        $user_role = $user->role->first();
        $role_id = $user_role->id;
        $role = $user_role->name;

        if ($user->status != 1) {
            return $this->response->error('Account is not active', 500);
        }

        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->dto = compact('user_id', 'email', 'role_id', 'role', 'token');

        return $this->_genericResponse;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthenticatedUser()
    {
        try {
            if (!$user = JWTAuth::parseToken()->authenticate()) {
                $error = ['statusText' => 'user_not_found', 'status' => 404];
                return response()->json(compact('error'));
            }
        } catch (TokenExpiredException $e) {
            $error = ['statusText' => 'token_expired', 'status' => $e->getStatusCode()];
            return response()->json(compact('error'));
        } catch (TokenInvalidException $e) {
            $error = ['statusText' => 'token_invalid', 'status' => $e->getStatusCode()];
            return response()->json(compact('error'));
        } catch (JWTException $e) {
            $error = ['statusText' => 'token_absent', 'status' => $e->getStatusCode()];
            return response()->json(compact('error'));
        }

        // the token is valid and we have found the user via the sub claim
        $error = ['statusText' => 'no_error', 'status' => 200];
        return response()->json(compact('error'));
    }

    public function signup(SignupAuthRequest $request)
    {
        $signup_key = Config::get('boilerplate.signup_fields');
        $signup_value = [$request->getEmail(), $request->getPassword()];

        $credentials = array_combine($signup_key, $signup_value);
        $validator = Validator::make($credentials, Config::get('boilerplate.signup_fields_rules'));

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        $user = $this->_authRepository->signup($credentials);

        if (!$user->id) {
            return $this->response->error('Could not create user', 500);
        }

        $data = $user->toArray();
        $this->sendEmailSignup($data);

        return $this->response->created();
    }

    public function recovery(RecoveryAuthRequest $request)
    {
        $credentials = [
            'email' => $request->getEmail()
        ];

        $validator = Validator::make($credentials, $request->rules());

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        $response = Password::sendResetLink($credentials, function (Message $message) {
            $message->subject(Config::get('boilerplate.recovery_email_subject'));
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return $this->response->noContent();

            case Password::INVALID_USER:
                return $this->response->errorNotFound();
        }
    }

    public function reset(ResetAuthRequest $request)
    {
        $credentials = [
            'email' => $request->getEmail(),
            'password' => $request->getPassword(),
            'password_confirmation' => $request->getPasswordConfirmation(),
            'token' => $request->getToken()
        ];

        $validator = Validator::make($credentials, $request->rules());

        if ($validator->fails()) {
            throw new ValidationHttpException($validator->errors()->all());
        }

        $response = Password::reset($credentials, function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                if(Config::get('boilerplate.reset_token_release')) {
                    return $this->login($request);
                }
                return $this->response->noContent();

            default:
                return $this->response->error('Could not reset password', 500);
        }
    }

    /**
     * @param $data
     */
    private function sendEmailSignup($data)
    {
        $template = 'auth.emails.signup';
        $data = [
            'to' => $data['email'],
            'from_address' => Config::get('mail.username'),
            'from_name' => 'No Reply',
            'subject' => 'Activation Digital 3',
            'email' => base64_encode($data['email'])
        ];

        Event::fire(new SendEmailEvent($template, $data));
    }
}