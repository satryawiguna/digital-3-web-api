<?php
namespace App\Services\Implement;


use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Responses\BaseResponse;
use App\Http\Responses\GenericPageResponse;
use App\Http\Responses\GenericResponse;
use App\Libraries\Crypt;
use App\Repositories\Contract\IUserRepository;
use App\Repositories\Criterias\Implement\User\GetUserByEmailCriteria;
use App\Services\Contract\IUserService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Kumuwai\DataTransferObject\Laravel5DTO;

class UserService extends BaseService implements IUserService
{
    private $_userRepository;

    /**
     * UserService constructor.
     * @param IUserRepository $userRepository
     */
    public function __construct(IUserRepository $userRepository)
    {
        $this->_userRepository = $userRepository;
    }

    /**
     * @param $id
     * @return GenericResponse
     */
    public function getDetail($id)
    {
        $model = $this->_userRepository->skipCriteria()
            ->with(['role'])->fetchFind($id);

        $output = new Laravel5DTO([
            'id' => (int)$model->id,
            'email' => $model->email,
            'handphone_code_id' => (int)$model->handphone_code_id,
            'handphone' => $model->handphone,
            'status' => (int)$model->status,
            'role' => $model->role
        ]);


        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }

    public function save(CreateUserRequest $request)
    {
        // TODO: Implement save() method.
    }

    /**
     * @param UpdateUserRequest $request
     * @return BaseResponse
     */
    public function update(UpdateUserRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                if (!empty($request->password)) {
                    $request->password = \Hash::make($request->password);
                }

                $this->_baseResponse->_result = $this->_userRepository->update($request);
                $this->_baseResponse->addSuccessMessage("Success user updated");

            } catch (Exception $ex) {
                $this->_baseResponse->addErrorMessage($ex->getMessage());

            }
        }

        return $this->_baseResponse;
    }

    /**
     * @param $email
     * @return BaseResponse
     */
    public function userActivate($email)
    {
        $this->_baseResponse = new BaseResponse();

        try {
            $this->_baseResponse->_result = $this->_userRepository->userActivate(base64_decode($email));
            $this->_baseResponse->addSuccessMessage("Activate success");

        } catch (Exception $ex) {
            $this->_baseResponse->addErrorMessage($ex->getMessage());
        }

        return $this->_baseResponse;
    }

    /**
     * @param $email
     * @return GenericPageResponse
     */
    public function getUserByEmail($email)
    {
        $models = $this->_userRepository->pushCriteria(new GetUserByEmailCriteria($email));
        $models = $models->fetchAll();

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => (int)$model->id,
                'email' => $model->email
            ]);

        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }
}