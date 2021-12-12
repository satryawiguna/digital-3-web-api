<?php
namespace App\Repositories\Implement;


use App\Http\Requests\Role\CreateRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Repositories\Contract\IRoleRepository;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class RoleRepository extends BaseRepository implements IRoleRepository
{
    /**
     * RoleRepository constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->_criteria = new Collection();
    }

    /**
     * @return string
     */
    public function model()
    {
        return 'App\Models\Role';
    }

    /**
     * @param CreateRoleRequest $request
     * @return int|mixed
     */
    public function create(CreateRoleRequest $request)
    {
        $role = $this->_model;

        $role->name = strtolower($request->getName());
        $role->description = $request->getDescription();
        $role->created_at = Carbon::now();

        return $role->save() ? $role->id : 0;
    }

    /**
     * @param UpdateRoleRequest $request
     * @return int
     */
    public function update(UpdateRoleRequest $request)
    {
        $role = $this->_model->find($request->getId());

        $role->name = strtolower($request->getName());
        $role->description = $request->getDescription();
        $role->updated_at = Carbon::now();

        return $role->save() ? $role->id : 0;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $role = $this->_model->whereId($id);

        return $role->delete();
    }

}