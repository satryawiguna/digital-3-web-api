<?php
namespace App\Services\Implement;


use App\Http\Requests\GenericPageRequest;
use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Http\Responses\BaseResponse;
use App\Http\Responses\GenericPageResponse;
use App\Http\Responses\GenericResponse;
use App\Repositories\Contract\IRoleRepository;
use App\Repositories\Criterias\Implement\Role\GetAllRoleCriteria;
use App\Services\Contract\IRoleService;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Kumuwai\DataTransferObject\Laravel5DTO;

class RoleService extends BaseService implements IRoleService
{
    private $_roleRepository;

    /**
     * RoleService constructor.
     * @param IRoleRepository $roleRepository
     */
    public function __construct(IRoleRepository $roleRepository)
    {
        $this->_roleRepository = $roleRepository;
    }

    /**
     * @param GenericPageRequest $pageRequest
     * @return GenericResponse
     */
    public function getAll(GenericPageRequest $pageRequest)
    {
        $models = $this->_roleRepository->pushCriteria(new GetAllRoleCriteria($pageRequest->getSearch()))
            ->orderBy($pageRequest->columns[$pageRequest->order['column']]['name'], $pageRequest->order['dir']);

        $all = $models->fetchAll($reset = false)->count();
        $models = $models->offsetPagination($pageRequest->getLength(), $pageRequest->getStart());

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => (int)$model->id,
                'name' => $model->name,
                'description' => $model->description
            ]);

        $this->_genericPageResponse = new GenericPageResponse();
        $this->_genericPageResponse->setDraw($pageRequest->draw);
        $this->_genericPageResponse->setRecordsTotal($all);
        $this->_genericPageResponse->setRecordsFiltered($all);
        $this->_genericPageResponse->setDto(Collection::make($output));

        return $this->_genericPageResponse;
    }

    /**
     * @param $id
     * @return GenericResponse
     */
    public function getDetail($id)
    {
        $model = $this->_roleRepository->skipCriteria()->fetchFind($id);

        $output = new Laravel5DTO([
            'id' => (int)$model->id,
            'name' => $model->name,
            'description' => $model->description
        ]);


        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }

    /**
     * @param CreateRoleRequest $request
     * @return \App\Http\Responses\BaseResponse
     */
    public function save(CreateRoleRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $modelByRole = $this->_roleRepository->skipCriteria()->fetchFindSearch([
                    ['name', '=', strtolower($request->getRole())]
                ]);

                if ($modelByRole->count() == 0) {
                    $this->_baseResponse->_result = $this->_roleRepository->create($request);
                    $this->_baseResponse->addSuccessMessage("Role created");

                } else {
                    $this->_baseResponse->addErrorMessage('Role is already exists');

                }

            } catch (Exception $ex) {
                $this->_baseResponse->addErrorMessage($ex->getMessage());

            }
        }

        return $this->_baseResponse;
    }

    /**
     * @param UpdateRoleRequest $request
     * @return \App\Http\Responses\BaseResponse
     */
    public function update(UpdateRoleRequest $request)
    {
        $this->_baseResponse = new BaseResponse();
        $validator = Validator::make((array) $request, $request->rules());

        if ($validator->fails()) {
            $this->_baseResponse->addErrorMessage($validator->errors()->all());

        } else {
            try {
                $modelByIdAndRole = $this->_roleRepository->skipCriteria()->fetchFindSearch([
                    ['id', '<>', $request->getId()],
                    ['name', '=', strtolower($request->getRole())]
                ]);

                if ($modelByIdAndRole->count() == 0) {
                    $this->_baseResponse->_result = $this->_roleRepository->update($request);
                    $this->_baseResponse->addSuccessMessage("Role updated");

                } else {
                    $this->_baseResponse->addErrorMessage('Role is already exists');

                }

            } catch (Exception $ex) {
                $this->_baseResponse->addErrorMessage($ex->getMessage());

            }
        }

        return $this->_baseResponse;
    }

    /**
     * @param $id
     * @return \App\Http\Responses\BaseResponse
     */
    public function delete($id)
    {
        $this->_baseResponse = new BaseResponse();

        try {
            $this->_baseResponse->_result = $this->_roleRepository->delete($id);
            $this->_baseResponse->addSuccessMessage("Role deleted");

        } catch (Exception $ex) {
            $this->_baseResponse->addErrorMessage($ex->getMessage());
        }

        return $this->_baseResponse;
    }

    /**
     * @return GenericResponse
     */
    public function getRoleList()
    {
        $models = $this->_roleRepository->skipCriteria();
        $models = $models->orderBy('id', 'asc');
        $models = $models->fetchAll();

        $output = [];

        foreach($models as $model)
            $output[] = new Laravel5DTO([
                'id' => (int)$model->id,
                'name' => $model->name
            ]);

        $this->_genericResponse = new GenericResponse();
        $this->_genericResponse->setDto(Collection::make($output));

        return $this->_genericResponse;
    }
}